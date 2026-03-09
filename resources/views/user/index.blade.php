@extends('layouts.app', ['activePage' => 'user', 'titlePage' => __('Usuários')])
@section('content')
    <div class="w-full p-10 flex flex-col gap-5">
        <h1>Usuários</h1>
        <div class="w-full">
            <div class="w-full flex gap-5">
                <div class="flex items-center gap-2 w-5/12">
                    <input type="text" class="w-10/12 rounded" placeholder="Pesquisar">
                    <button class="bg-secondary"><i class="fa fa-search"></i></button>
                </div>
                <a href="{{ route('user.create') }}" class="btn bg-primary">Adicionar</a>
            </div>
        </div>
        <div class="w-full">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-start">Nome</th>
                        <th>Criado em</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td class="text-center">{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="p-1">
                                <div class="flex gap-3 justify-end">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn bg-warning"><i
                                            class="fa fa-pencil"></i></a>
                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-danger"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Nenhum usuário encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="w-full">
            {{ $users->links() }}
        </div>
    </div>
@endsection
