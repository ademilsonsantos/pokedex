
<div class="w-full flex flex-col">
    <div class="w-full flex flex-col">
        <label for="">Nome da permissão</label>
        <input type="text" name="name" class="w-full rounded" placeholder="Nome da permissão" value="{{ old('name', $role->name ?? '') }}"/>
        @error('name')
            <div class="alert text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="w-full flex gap-3 mt-10 flex-wrap">
        @forelse($permissions as $permission)
            <div class="w-2/12 full flex items-center gap-2">
                <input type="checkbox" name="permissions[]" value="{{ $permission->value }}" id="permission_{{ $permission->value }}" {{ isset($role) && $role->permissions->pluck('name')->contains($permission->value) ? 'checked' : '' }}>
                <label for="permission_{{ $permission->value }}">{{ $permission->label() }}</label>
            </div>
        @empty
            <p>Nenhuma permissão encontrada.</p>
        @endforelse
    </div>
</div>
