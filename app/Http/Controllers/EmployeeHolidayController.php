<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\EmployeeHolidayService;
use App\Http\Requests\StoreEmployeeHolidayRequest;

class EmployeeHolidayController extends Controller
{
    protected EmployeeHolidayService $holidayService;

    public function __construct(EmployeeHolidayService $holidayService)
    {
        $this->holidayService = $holidayService;
    }

    public function store(StoreEmployeeHolidayRequest $request, Employee $employee)
    {
        $validated = $request->validated();

        try {
            $this->holidayService->addHoliday($employee->id, $validated['date']);

            return response()->json(['message' => 'Holiday added successfully.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getRemainingHolidays(Employee $employee)
    {
        try {
            $remaining = $this->holidayService->getRemainingHolidays($employee->id);

            return response()->json(['remaining_holidays' => $remaining], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getEmployeeHolidays(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        try {
            $employees = $this->holidayService->getEmployeeHolidays($request->start_date, $request->end_date);
            return response()->json($employees, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
