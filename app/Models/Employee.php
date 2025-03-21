<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'country_id', 'start_date', 'end_date'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function holidays()
    {
        return $this->hasMany(EmployeeHoliday::class);
    }
}
