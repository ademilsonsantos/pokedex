<?php

namespace App\Services\PokeApi;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PokeApiClient
{
    protected $baseUrl = 'https://pokeapi.co/api/v2/';

    public function getPokemonByName($name)
    {
        if (Cache::has("pokemon_$name")) {
            return Cache::get("pokemon_$name");
        }

        $data = Http::get($this->baseUrl . 'pokemon/' . $name);

        switch ($data->status()) {
            case 200:
                $dataJson = $data->json();
                $forms = array_map(function ($form) {
                    $id = explode('/', $form['url'])[6];
                    return $this->getFormsByNameOrId($id);
                }, $dataJson['forms'] ?? []);

                $dataJson['forms'] = $forms;
                Cache::forever("pokemon_$name", $dataJson);
                return $dataJson;
            case 404:
                return [
                    'error' => 'Pokemon não encontrado'
                ];
            default:
                return [
                    'error' => "Erro ao conectar com a PokeAPI: " . $data->status()
                ];
        }
    }

    public function getFormsByNameOrId($idOrName)
    {
        if (Cache::has("pokemon_forms_$idOrName")) {
            return Cache::get("pokemon_forms_$idOrName");
        }

        $data = Http::get($this->baseUrl . 'pokemon-form/' . $idOrName);

        switch ($data->status()) {
            case 200:
                Cache::forever("pokemon_forms_$idOrName", $data->json());
                return $data->json();
            case 404:
                return [
                    'error' => 'Forma não encontrada'
                ];
            default:
                return [
                    'error' => "Erro ao conectar com a PokeAPI: " . $data->status()
                ];
        }
    }

    public function getColorByNameOrId($idOrName)
    {
        if (Cache::has("pokemon_color_$idOrName")) {
            return Cache::get("pokemon_color_$idOrName");
        }

        $data = Http::get($this->baseUrl . 'pokemon-color/' . $idOrName);

        switch ($data->status()) {
            case 200:
                $dataJson = $data->json();
                $forms = array_map(function ($form) {
                    $id = explode('/', $form['url'])[6];
                    return $this->getFormsByNameOrId($id);
                }, $dataJson['forms'] ?? []);

                $dataJson['forms'] = $forms;
                Cache::forever("pokemon_color_$idOrName", $dataJson);
                return $dataJson;
            case 404:
                return [
                    'error' => 'Cor não encontrada'
                ];
            default:
                return [
                    'error' => "Erro ao conectar com a PokeAPI: " . $data->status()
                ];
        }
    }

    public function getCharacteristicByNameOrId($idOrName)
    {
        if (Cache::has("pokemon_characteristic_$idOrName")) {
            return Cache::get("pokemon_characteristic_$idOrName");
        }

        $data = Http::get($this->baseUrl . 'characteristic/' . $idOrName);

        switch ($data->status()) {
            case 200:
                Cache::forever("pokemon_characteristic_$idOrName", $data->json());
                return $data->json();
            case 404:
                return [
                    'error' => 'Característica não encontrada'
                ];
            default:
                return [
                    'error' => "Erro ao conectar com a PokeAPI: " . $data->status()
                ];
        }
    }
}
