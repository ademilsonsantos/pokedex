<?php

namespace App\Services;

use App\Models\Abilities;
use App\Models\Pokemon;
use App\Services\PokeApi\PokeApiClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PokemonImporter
{
    public function __construct(
        private PokeApiClient $client
    ) {}

    public function import($name)
    {
        try {
            $data = $this->client->getPokemonByName($name);

            $abilities = array_map(function ($ability) {
                return [
                    'name' => $ability['ability']['name']
                ];
            }, $data['abilities']);

            $path = $this->importSprite($data['sprites']['front_default']);

            $pokemon = Pokemon::firstOrCreate(
                ['name' => $data['name']],
                ['height' => $data['height'], 'weight' => $data['weight'], 'sprite' => $path]
            );

            if(!$pokemon->abilities->count()) {
                Abilities::upsert($abilities, ['name']);

                $abilitiesModel = Abilities::whereIn('name', array_column($abilities, 'name'))->get();
                $pokemon->abilities()->attach($abilitiesModel);
            };

            return $pokemon;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function importSprite($sprite)
    {
        try {
            $response = Http::get($sprite);
            $filename = 'pokemon/' . uniqid() . '.png';
            Storage::disk('public')->put($filename, $response->body());

            return $filename;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateFavorite($id, $attach = true)
    {
        try {
            if($attach)
                auth()->user()->pokemon()->attach($id);
            else
                auth()->user()->pokemon()->detach($id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
