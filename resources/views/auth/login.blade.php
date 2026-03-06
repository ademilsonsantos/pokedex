@extends('layouts.app')
@section('content')
    <div class="w-6/12">
        <form action="">
            <div class="w-full flex flex-col">
                <label for="">Usuário</label>
                <input class="w-full" type="text">
            </div>
            <div class="w-full flex flex-col">
                <label for="">Senha</label>
                <input class="w-full" type="text" placeholder="Digite seu usuário">
            </div>
        </form>
    </div>
@endsection
