<?

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
}
