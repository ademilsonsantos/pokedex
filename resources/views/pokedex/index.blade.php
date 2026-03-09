@extends('layouts.app', ['title' => 'Minha Pokédex'])
@section('content')
    <div class="w-full p-10">
        <h1 class="text-2xl font-bold mb-4">Importar pokemons</h1>
        <div class="w-full mt-10 flex gap-5">
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
            @role('viewer')
                <div class="w-4/12 flex flex-col">
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
            @endrole
            @role('editor')
                <div class="w-4/12 flex flex-col">
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
            @endrole
        </div>
        <div id="pokemon-container" class="w-full mt-10 flex flex-wrap gap-5">
            @forelse($pokemons as $pokemon)
                <div class="w-2/12 bg-gray-200 p-5 rounded flex flex-col items-center justify-between">
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
                        @role('admin')
                            <form action="{{ route('pokemon.destroy', $pokemon->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn bg-danger mt-4"><i class="fa fa-trash"></i></button>
                            </form>
                        @endrole
                        @hasanyrole('admin|editor')
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
                        @endrole
                        <a href="{{route('pokemon.show', $pokemon->id)}}" class="btn bg-primary"><i class="fa fa-eye"></i></a>
                    </div>
                </div>
            @empty
                <span>Nenhum pokemon encontrado.</span>
            @endforelse
        </div>
    </div>
@endsection
{{-- @push('js')
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        const pokeByNammeApiUrl = 'https://pokeapi.co/api/v2/pokemon';
        const pokemonContainerJQ = $('#pokemon-container');

        $(document).ready(function() {
            $('#btn-search').on('click', function() {
                $(this).addClass('loading');

                var pokemonName = $('#pokemon-name').val();
                if (pokemonName) {
                    $.ajax({
                        url: `${pokeByNammeApiUrl}/${pokemonName.toLowerCase()}`,
                        method: 'GET',
                        timeout: 5000,
                        success: function(response) {
                            // Processar a resposta e atualizar a interface
                            montarPokemonCard({
                                name: response.name,
                                image: response.sprites.front_default,
                                abilities: response.abilities
                            })
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $(this).removeClass('loading');
                            if (textStatus === 'timeout') {
                                alert(
                                    'A requisição demorou demais. Tente novamente mais tarde.');
                            } else if (jqXHR.status === 404) {
                                alert('Pokemon não encontrado.');
                            } else if (jqXHR.status === 500) {
                                alert('Erro interno no servidor. Tente novamente mais tarde.');
                            } else {
                                console.log('Erro:', errorThrown);
                                alert('Ocorreu um erro. Tente novamente mais tarde.');
                            }
                        }
                    });
                } else {
                    alert('Por favor, digite o nome do pokemon.');
                }
            });

            function montarPokemonCard(pokemon) {
                const pokemonCard = `
                    <div class="w-2/12 bg-gray-200 p-5 rounded flex flex-col items-center">
                        <h2 class="text-xl font-bold mb-2">${pokemon.name}</h2>
                        <img src="${pokemon.image}" alt="Pokemon Image" >
                        <h3 class="text-lg font-semibold mt-4">Habilidades:</h3>
                       <ul>
                            ${pokemon.abilities.map(ability => `<li>${ability.ability.name}</li>`).join('')}
                        </ul>
                        <button class="btn bg-success mt-4">Importar</button>
                    </div>
                `;
                pokemonContainerJQ.html(pokemonCard);
            }
        });
    </script>
@endpush --}}
