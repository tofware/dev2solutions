<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

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
