@extends('layouts.app', ['title' => 'Minha Pokédex'])
@section('content')
    <div class="w-full p-10">
        <h1 class="text-2xl font-bold mb-4">Pokemons importados</h1>
        <div class="w-full">
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="w-full mt-10 flex gap-5">
            @can(\App\Enums\PermissionEnum::POKEMON_VIEW->value)
                <div class="w-5/12 flex flex-col">
                    <label for="">Pesquisar pokemon por nome.</label>
                    <form action="{{ route('pokemon.index') }}" class="w-full flex gap-5 items-start" method="GET">
                        @csrf
                        <div class="w-8/12 flex flex-col">
                            <input id="pokemon-name" name="name" type="text" class="w-full"
                                placeholder="Digite o nome do pokemon" value="{{ $name ?? '' }}">
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button id="btn-search" class="btn bg-primary h-full">
                            <i class="fa fa-search"></i>
                            Pesquisar
                        </button>
                    </form>
                </div>
            @endcan
            @can(\App\Enums\PermissionEnum::POKEMON_IMPORT->value)
                <div class="w-5/12 flex flex-col">
                    <label for="">Importar pokemon por nome.</label>
                    <form action="{{ route('pokemon.import') }}" class="w-full flex gap-5 items-start" method="POST">
                        @csrf
                        <div class="w-8/12 flex flex-col">
                            <input id="pokemon-name" name="name" type="text" class="w-full"
                                placeholder="Digite o nome do pokemon">
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <button id="btn-search" class="btn bg-success h-full">
                            <i class="fa fa-search"></i>
                            Importar
                        </button>
                    </form>
                </div>
            @endcan
        </div>
        <div id="pokemon-container" class="w-full mt-10 flex flex-wrap gap-5">
            @forelse($pokemons as $pokemon)
                <div class="w-3/12 [1400px]:w-2/12 bg-gray-200 p-5 rounded flex flex-col items-center justify-between">
                    <h2 class="text-xl font-bold mb-2">{{ $pokemon->name }}</h2>
                    <img src="storage/{{ $pokemon->sprite }}" alt="Pokemon Image">
                    <h3 class="text-lg font-semibold mt-4">Habilidades:</h3>
                    @if ($pokemon->abilities)
                        <ul>
                            @foreach ($pokemon->abilities as $ability)
                                <li>{{ $ability->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="w-ful flex items-center gap-3">
                        @can(\App\Enums\PermissionEnum::POKEMON_DELETE->value)
                            <form action="{{ route('pokemon.destroy', $pokemon->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn bg-danger mt-4"><i class="fa fa-trash"></i></button>
                            </form>
                        @endcan
                        @can(\App\Enums\PermissionEnum::POKEMON_FAVORITE->value)
                            <form action="{{ route('pokemon.favorite', $pokemon->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if (auth()->user()->pokemon->contains($pokemon->id))
                                    <button type="submit" class="btn mt-4 bg-white"><i
                                            class="fa fa-heart text-danger"></i></button>
                                @else
                                    <button type="submit" class="btn mt-4 bg-white"><i
                                            class="fa fa-heart text-secondary"></i></button>
                                @endif
                            </form>
                        @endcan
                        <a href="{{ route('pokemon.show', $pokemon->id) }}" class="btn mt-4 bg-primary"><i
                                class="fa fa-eye"></i></a>
                    </div>
                </div>
            @empty
                <span>Nenhum pokemon encontrado.</span>
            @endforelse
        </div>
        <div class="w-full mt-10">
            {{ $pokemons->links() }}
        </div>
    </div>
@endsection
