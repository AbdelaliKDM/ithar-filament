<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    protected $fillable = [
        'widow_id',
        'housing_type',
        'building_type',
        'building_condition',
        'furniture_condition',
        'clothing_condition',
        'rent_cost',
        'members_num',
        'students_num',
        'has_fridge',
        'has_cooker',
        'has_tv',
        'has_ac'
    ];

    protected $casts = [
        'rent_cost' => 'float',
        'has_fridge' => 'boolean',
        'has_cooker' => 'boolean',
        'has_tv' => 'boolean',
        'has_ac' => 'boolean'
    ];

    public function widow()
    {
        return $this->belongsTo(Widow::class);
    }
}
