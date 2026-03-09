<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abilities extends Model
{
    protected $fillable = ['name'];

    public function pokemon()
    {
        return $this->belongsToMany(Pokemon::class);
    }
}
