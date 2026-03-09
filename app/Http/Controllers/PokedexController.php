<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonRequest;
use App\Models\Pokemon;
use App\Services\PokeApi\PokeApiClient;
use App\Services\PokemonImporter;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class PokedexController extends Controller
{
    public function index(Request $request) {
        Gate::authorize('viewAny', Pokemon::class);
        $pokemons = Pokemon::paginate(15);
        $name = $request->name;

        if($name) {
            $pokemons = Pokemon::where('name', 'like', "%$name%")->get();
        }

        return view('pokedex.index', compact('pokemons', 'name'));
    }

    public function destroy($id) {
        try {
            $pokemon = Pokemon::findOrFail($id);
            Gate::authorize('delete', $pokemon);
            Storage::disk('public')->delete($pokemon->sprite);
            $pokemon->delete();
            return redirect()->route('pokemon.index')->with('success', 'Pokemon removido com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao remover Pokemon: ' . $e->getMessage());
            return redirect()->route('pokemon.index')->with('error', 'Ocorreu um erro ao remover o Pokemon');
        }
    }

    public function import(PokemonRequest $request, PokemonImporter $import) {
        Gate::authorize('create', Pokemon::class);
        try {
            $import->import($request->name);
            return redirect()->route('pokemon.index')->with('success', 'Pokemon importado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao importar Pokemon: ' . $e->getMessage());

            return redirect()->route('pokemon.index')->with('error', $e->getMessage());
        }
    }

    public function favorite($id, PokemonImporter $import) {
        Gate::authorize('create', Pokemon::class);
        try {
            $import->updateFavorite($id, !auth()->user()->pokemon->contains($id));
            return redirect()->route('pokemon.index')->with('success', 'Pokemon favoritado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao favoritar Pokemon: ' . $e->getMessage());
            return redirect()->route('pokemon.index')->with('error', 'Ocorreu um erro ao favoritar o Pokemon');
        }
    }

    public function show($id, PokeApiClient $client) {
        try {
            $pokemon = Pokemon::findOrFail($id);

            Gate::authorize('view', $pokemon);
            $pokemonDetail = $client->getPokemonByName($pokemon->name);

            if(isset($pokemonDetail['error'])) {
                return redirect()->route('pokemon.index')->with('error', $pokemonDetail['error']);
            }

            return view('pokedex.show', compact('pokemon', 'pokemonDetail'));
        } catch (\Exception $e) {
            Log::error('Erro ao buscar detalhes do Pokemon: ' . $e->getMessage());
            return redirect()->route('pokemon.index')->with('error', 'Ocorreu um erro ao buscar os detalhes do Pokemon');
        }
    }
}
