<?php

namespace App\Models;

use App\Policies\PokemonPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;

#[UsePolicy(PokemonPolicy::class)]
class Pokemon extends Model
{
    protected $fillable = ['name', 'sprite', 'height', 'weight'];

    public function abilities()
    {
        return $this->belongsToMany(Abilities::class);
    }
}
