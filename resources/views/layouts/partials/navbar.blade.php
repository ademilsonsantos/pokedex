<aside class="w-3/12 bg-gray-200 h-screen p-4">
    <div class="flex flex-col gap-10">
        <h1 class="font-bold text-2xl">
            Bem vindo, {{ auth()->user()->name }}!
        </h1>
        <ul>
            <li>
                <a href="">Pokedex</a>
            </li>
            <li>
                <a href="">Usuários</a>
            </li>
            <li>
                <a href="">Permissões</a>
            </li>
        </ul>
    </div>
</aside>
