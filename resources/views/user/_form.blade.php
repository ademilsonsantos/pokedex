<div class="w-5/12 flex flex-wrap gap-5">
    <div class="w-full flex flex-col">
        <label for="">Nome</label>
        <input type="text" name="name" class="w-full rounded" placeholder="Nome do usuário"
            value="{{ old('name', $user->name ?? '') }}" />
        @error('name')
            <div class="alert text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="w-full flex flex-col">
        <label for="">Permissão</label>
        <select name="role" id="role">
            <option value="">Selecionar</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}"
                    {{ isset($user) && $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
        @error('role')
            <div class="alert text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="w-full flex flex-col">
        <label for="">Email</label>
        <input type="text" name="email" class="w-full rounded" placeholder="Nome do usuário"
            value="{{ old('email', $user->email ?? '') }}" />
        @error('email')
            <div class="alert text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="w-full flex flex-col">
        <label for="">Senha</label>
        <div class="w-full flex items-center relative">
            <input name="password" class="w-full" type="password" placeholder="Digite sua senha">
            <i class="fa fa-eye absolute right-2 text-gray-600" onclick="showHidePassword()"></i>
            <i class="fa fa-eye-slash right-2 text-gray-600 absolute hidden!" onclick="showHidePassword()"></i>
        </div>
        @error('password')
            <div class="alert text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="w-full flex flex-col">
        <label for="">Confirmar senha</label>
        <div class="w-full flex items-center relative">
            <input name="password_confirmation" class="w-full" type="password" placeholder="Confirme sua senha">
        </div>
    </div>
</div>
