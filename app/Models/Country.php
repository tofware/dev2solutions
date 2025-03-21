<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'holiday_entitlement'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function publicHolidays()
    {
        return $this->hasMany(PublicHoliday::class);
    }
}
