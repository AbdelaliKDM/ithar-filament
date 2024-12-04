<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widow extends Model
{
    protected $fillable = [
        'fullname',
        'birthdate',
        'phone',
        'salary',
        'education_level',
        'address',
        'ccp_number',
        'health_status',
        'occupation',
        'insurance'
    ];

    protected $casts = [
        'birthdate' => 'date',
        'salary' => 'float',
        'insurance' => 'boolean'
    ];

    public function spouse()
    {
        return $this->hasOne(Spouse::class);
    }

    public function orphans()
    {
        return $this->hasMany(Orphan::class);
    }

    public function household()
    {
        return $this->hasOne(Household::class);
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function salaries()
    {
        return $this->hasMany(Income::class)->where('type','salary');
    }

    public function bonuses()
    {
        return $this->hasMany(Income::class)->where('type','bonus');
    }
}
