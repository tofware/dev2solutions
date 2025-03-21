<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

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
