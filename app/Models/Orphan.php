<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orphan extends Model
{
    protected $fillable = [
        'commune_id',
        'widow_id',
        'fullname',
        'birthdate',
        'health_status',
        'occupation',
        'workplace',
        'at_home',
        'married'
    ];

    protected $casts = [
        'birthdate' => 'date',
        'at_home' => 'boolean',
        'married' => 'boolean'
    ];

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function widow()
    {
        return $this->belongsTo(Widow::class);
    }
}
