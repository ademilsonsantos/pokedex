<?php

namespace App\Enums;

enum PermissionEnum: string {
    case POKEMON_VIEW = 'pokemon.view';
    case POKEMON_IMPORT = 'pokemon.import';
    case POKEMON_DELETE = 'pokemon.delete';
    case POKEMON_FAVORITE = 'pokemon.favorite';

    case USER_CREATE = 'user.create';
    case USER_VIEW = 'user.view';
    case USER_UPDATE = 'user.update';
    case USER_DELETE = 'user.delete';

    case ROLE_CREATE = 'role.create';
    case ROLE_VIEW = 'role.view';
    case ROLE_UPDATE = 'role.update';
    case ROLE_DELETE = 'role.delete';

    public function label() : string {
        return match($this) {
            self::POKEMON_VIEW => 'Visualizar Pokemons',
            self::POKEMON_IMPORT => 'Importar Pokemons',
            self::POKEMON_DELETE => 'Deletar Pokemons',
            self::POKEMON_FAVORITE => 'Favoritar Pokemons',
            self::USER_CREATE => 'Criar Users',
            self::USER_VIEW => 'Visualizar Users',
            self::USER_UPDATE => 'Atualizar Users',
            self::USER_DELETE => 'Deletar Users',
            self::ROLE_CREATE => 'Criar Roles',
            self::ROLE_VIEW => 'Visualizar Roles',
            self::ROLE_UPDATE => 'Atualizar Roles',
            self::ROLE_DELETE => 'Deletar Roles',
        };
    }
}
