@extends('layouts.app', ['activePage' => 'permission', 'titlePage' => __('Adicionar Permissão')])
@section('content')
    <div class="w-full p-10 flex flex-col gap-5">
        <a href="{{route('permission.index')}}">Voltar</a>
        <h1>Adicionar Permissão</h1>
        <div class="w-full">
            <form action="{{ route('permission.store') }}" method="POST" class="w-full flex flex-col gap-5">
                @csrf
                @include('permission._form')
                <button type="submit" class="bg-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
