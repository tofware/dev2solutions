<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicHoliday extends Model
{
    protected $fillable = ['country_id', 'date', 'name'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
