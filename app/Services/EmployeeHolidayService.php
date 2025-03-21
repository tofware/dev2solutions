<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\EmployeeHoliday;
use Illuminate\Support\Facades\DB;
use Exception;

class EmployeeHolidayService
{
    public function addHoliday(int $employeeId, string $date): bool
    {
        return DB::transaction(function () use ($employeeId, $date) {
            $employee = Employee::with('country')->findOrFail($employeeId);
            $countryHolidayEntitlement = $employee->country->holiday_entitlement;

            if ($date < $employee->start_date || ($employee->end_date && $date > $employee->end_date)) {
                throw new Exception('Holiday date is outside the contract period.');
            }

            if (EmployeeHoliday::where('employee_id', $employeeId)->where('date', $date)->exists()) {
                throw new Exception('Holiday already booked for this date.');
            }

            $year = date('Y', strtotime($date));
            $usedDays = EmployeeHoliday::where('employee_id', $employeeId)
                ->whereYear('date', $year)
                ->count();

            if ($usedDays >= $countryHolidayEntitlement) {
                throw new Exception('No remaining holiday days for this year.');
            }

            EmployeeHoliday::create(['employee_id' => $employeeId, 'date' => $date]);

            return true;
        });
    }

    public function getRemainingHolidays(int $employeeId): int
    {
        $employee = Employee::with('country')->findOrFail($employeeId);
        $countryEntitlement = $employee->country->holiday_entitlement;

        $startYear = (int) date('Y', strtotime($employee->start_date));
        $currentYear = (int) date('Y');
        $endYear = $employee->end_date ? (int) date('Y', strtotime($employee->end_date)) : $currentYear;

        $entitledDays = 0;
        for ($year = $startYear; $year <= $endYear; $year++) {
            $yearStartDate = max($employee->start_date, "$year-01-01");
            $yearEndDate = $employee->end_date ? min($employee->end_date, "$year-12-31") : "$year-12-31";

            $daysWorked = (strtotime($yearEndDate) - strtotime($yearStartDate)) / (60 * 60 * 24);
            $yearlyEntitlement = ($daysWorked / 365) * $countryEntitlement;

            $entitledDays += floor($yearlyEntitlement);
        }

        $usedDays = EmployeeHoliday::where('employee_id', $employeeId)->count();

        return max(0, $entitledDays - $usedDays);
    }

    public function getEmployeeHolidays(string $startDate, string $endDate)
    {
        return Employee::with('country')
            ->withCount([
                'holidays as total_holidays' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('date', [$startDate, $endDate]);
                }
            ])
            ->with([
                'country' => function ($query) use ($startDate, $endDate) {
                    $query->withCount([
                        'publicHolidays as total_public_holidays' => function ($query) use ($startDate, $endDate) {
                            $query->whereBetween('date', [$startDate, $endDate]);
                        }
                    ]);
                }
            ])
            ->get()
            ->map(function ($employee) {
                return [
                    'employee_id' => $employee->id,
                    'name' => $employee->name,
                    'total_holidays' => $employee->total_holidays,
                    'total_public_holidays' => $employee->country->total_public_holidays ?? 0,
                ];
            });
    }
}
