<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'widow_id',
        'name',
        'amount',
        'type'
    ];

    protected $casts = [
        'amount' => 'integer'
    ];

    public function widow()
    {
        return $this->belongsTo(Widow::class);
    }
}
