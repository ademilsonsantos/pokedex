@extends('layouts.app')
@push('css')
    <style type="text/Css">
        #login {
            background: #2A7B9B;
            background: linear-gradient(90deg, rgba(42, 123, 155, 1) 0%, rgba(87, 199, 133, 1) 50%, rgba(237, 221, 83, 1) 100%);
        }
    </style>
@endpush
@section('content')
    <div id="login" class="w-screen h-screen flex items-center justify-center">
        <div class="lg:w-3/12 px-4 py-6 bg-white flex flex-col gap-6">
            <h2 class="font-bold text-center">LOGIN</h2>
            <form action="{{route('login')}}" class="flex flex-col gap-4" method="POST">
                @csrf
                <div class="w-full flex flex-col">
                    <label for="">Email</label>
                    <input name="email" class="w-full bg-gray-50 px-3 py-2" type="text" placeholder="Digite seu usuário">
                </div>
                <div class="w-full flex flex-col">
                    <label for="">Senha</label>
                    <input name="password" class="w-full bg-gray-50 px-3 py-2" type="text" placeholder="Digite sua senha">
                </div>
                <button class="w-full text-white py-2 bg-primary">Login</button>
            </form>
        </div>
    </div>
@endsection
