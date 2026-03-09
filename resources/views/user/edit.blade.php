@extends('layouts.app', ['activePage' => 'user', 'titlePage' => __('Adicionar Usuário')])
@section('content')
    <div class="w-full p-10 flex flex-col gap-5">
        <a href="{{route('user.index')}}">Voltar</a>
        <h1>Editar Usuário</h1>
        <div class="w-5/12">
            <form action="{{ route('user.update', $user->id) }}" method="POST" class="w-full flex flex-col gap-5">
                @csrf
                @method('PUT')
                @include('user._form')
                <button type="submit" class="bg-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
