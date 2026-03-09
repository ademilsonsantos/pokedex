@extends('layouts.app', ['title' => 'Detalhes do Pokemon - ' . $pokemon->name])
@section('content')
    <div class="w-full p-10">
        <a href="{{ route('pokemon.index') }}">Voltar</a>
        <h1 class="text-2xl font-bold mb-4">Detalhes do Pokemon</h1>
        <div class="w-full mt-10 flex gap-5">
            <div class="w-3/12 p-5 rounded flex flex-col items-center bg-gray-200">
                <h2 class="text-xl font-bold mb-2">{{ $pokemon->name }}</h2>
                <img src="{{ asset('storage/' . $pokemon->sprite) }}" alt="Pokemon Image">
                <h3 class="text-lg font-semibold mt-4">Habilidades:</h3>
                <ul>
                    @foreach ($pokemon->abilities as $ability)
                        <li>{{ $ability->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="w-9/12 p-5 rounded flex flex-col items-center justify-between bg-gray-200">
                <h1>Formas</h1>
                <div class="w-full flex flex-wrap">
                    @forelse($pokemonDetail['forms'] as $form)
                        <div class="w-2/12 flex flex-col">
                            <h3 class="text-lg font-semibold mt-4">{{ $form['name'] }}</h3>
                            <img src="{{ $form['sprites']['front_default'] }}" alt="Pokemon Image">
                        </div>
                    @empty
                        <p>Nenhuma forma encontrada.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
