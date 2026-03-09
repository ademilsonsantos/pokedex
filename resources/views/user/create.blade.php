@extends('layouts.app', ['activePage' => 'user', 'titlePage' => __('Adicionar Permissão')])
@section('content')
    <div class="w-full p-10 flex flex-col gap-5">
        <a href="{{route('user.index')}}">Voltar</a>
        <h1>Adicionar Usuário</h1>
        <div class="w-5/12">
            <form action="{{ route('user.store') }}" method="POST" class="w-full flex flex-col gap-5">
                @csrf
                @include('user._form')
                <button type="submit" class="bg-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
