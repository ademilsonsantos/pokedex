<?

class PokemonDTO {
    public function __construct(
        public int $id,
        public string $name,
        public string $imageUrl,
        public array $types,
    ) {}
}
