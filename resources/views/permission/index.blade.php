@extends('layouts.app', ['activePage' => 'permission', 'titlePage' => __('Permissões')])
@section('content')
    <div class="w-full p-10 flex flex-col gap-5">
        <h1>Permissoes</h1>
        <div class="w-full">
            <div class="w-full flex gap-5">
                <form class="flex items-casdasenter gap-2 w-5/12" action="{{ route('permission.search') }}" method="GET">
                    <input name="name" type="text" class="w-10/12 rounded" placeholder="Pesquisar" value="{{$name ?? ''}}">
                    <button type="submit" class="bg-secondary"><i class="fa fa-search"></i></button>
                </form>
                <a href="{{ route('permission.create') }}" class="btn bg-primary">Adicionar</a>
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
                    @forelse($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td class="text-center">{{ $role->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="p-1">
                                <div class="flex gap-3 justify-end">
                                    <a href="{{ route('permission.edit', $role->id) }}" class="btn bg-warning"><i
                                            class="fa fa-pencil"></i></a>
                                    @if (!auth()->user()->hasRole($role->name))
                                        <form action="{{ route('permission.destroy', $role->id) }}" method="POST">
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
                            <td colspan="4">Nenhuma permissão encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="w-full">
            {{ $roles->links() }}
        </div>
    </div>
@endsection
