<?php
namespace App\Services\PokeApi;

use Illuminate\Support\Facades\Http;

class PokeApiClient {
    protected $baseUrl = 'https://pokeapi.co/api/v2/';

    public function getPokemonByName($name) {
        $data = Http::get($this->baseUrl . 'pokemon/' . $name);

        switch($data->status()) {
            case 200:
                return $data->json();
            case 404:
                throw new \Exception("Pokemon não encontrado");
            default:
                throw new \Exception("Erro ao conectar com a PokeAPI: " . $data->status());
        }
    }
}
