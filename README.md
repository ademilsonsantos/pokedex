## Tecnologias

* PHP
* Laravel
* MySql
* Tailwind

---

## Requisitos

Antes de começar, você precisa ter instalado:

* PHP 8.x
* Composer
* Banco de dados (MySQL)

---

## Instalação

Clone o projeto:

```bash
git clone https://github.com/ademilsonsantos/pokedex
cd projeto
```

Instale as dependências:

```bash
composer install
npm install
```

Caso não haja o .env.example, configure o ambiente:

```bash
cp .env.example .env
php artisan key:generate
```

Execute as migrations juntamente com o seeder para criar os usuários Viewer, Editor, Admin:

```bash
php artisan migrate --seed
```

Email: <view|editor|admin>@example.com
Senha: password

---

## Rodando o projeto

Inicie o servidor:

```bash
php artisan serve
```

Frontend:

```bash
npm run dev
```

A aplicação ficará disponível em:

```
http://localhost:8000
```

---

## Estrutura do Projeto

```
app/
 ├ Actions (Fortify)
 ├ Enums
 ├  └ PermissionEnum.php
 ├ Http
 │  ├ Controllers
 │  └ Requests
 ├ Models
 ├ Policies
 ├ Services
 ├  └ PokeApi
 ├       └ PokeApiClient.php
 └ └ PokemonImporter.php
    

routes/
 └ web.php
```
