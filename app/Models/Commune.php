<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $fillable = ['province_id', 'name'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function orphans()
    {
        return $this->hasMany(Orphan::class);
    }
}
