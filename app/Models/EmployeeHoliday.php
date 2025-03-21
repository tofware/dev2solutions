<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeHoliday extends Model
{
    protected $fillable = ['employee_id', 'date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
