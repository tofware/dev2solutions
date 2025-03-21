<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeHolidayController;

Route::prefix('employee-holiday')->group(function () {
    Route::post('/{employee}', [EmployeeHolidayController::class, 'store']);
    Route::get('/{employee}/remaining', [EmployeeHolidayController::class, 'getRemainingHolidays']);
});

Route::get('/employee-holidays', [EmployeeHolidayController::class, 'getEmployeeHolidays']);
