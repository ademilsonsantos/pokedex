<aside class="w-3/12 bg-gray-200 h-screen p-4 sticky top-0">
    <div class="flex flex-col gap-10">
        <div class="w-full flex gap-3 items-center">
            <h1 class="font-bold text-2xl">
                Bem vindo, {{ explode(' ', auth()->user()->name)[0] ?? 'Usuário' }}!
            </h1>
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit"><i class="fa-solid fa-arrow-right-from-bracket text-black"></i></button>
            </form>
        </div>
        <ul>
            <li>
                <a href="">Pokedex</a>
            </li>
            @role('admin')
                <li>
                    <a href="">Usuários</a>
                </li>
                <li>
                    <a href="{{route('permission.index')}}">Permissões</a>
                </li>
            @endrole
        </ul>
    </div>
</aside>
