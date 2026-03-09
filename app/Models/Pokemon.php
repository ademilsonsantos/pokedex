<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $fillable = ['name', 'sprite', 'height', 'weight'];

    public function abilities()
    {
        return $this->belongsToMany(Abilities::class);
    }
}
