<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicHoliday extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'date', 'name'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
