<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spouse extends Model
{
    protected $fillable = [
        'widow_id',
        'name',
        'birthdate',
        'deathdate'
    ];

    protected $casts = [
        'birthdate' => 'date',
        'deathdate' => 'date'
    ];

    public function widow()
    {
        return $this->belongsTo(Widow::class);
    }
}
