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
cd pokedex
```

Instale as dependências:

```bash
composer install
npm install
```

Configure o ambiente, para Windows:

```bash
copy .env.example .env

```

Para Linux:

```bash
cp .env.example .env
```

Gerando a chave:

```bash
php artisan key:generate
```

Execute as migrations juntamente com o seeder para criar os usuários Viewer, Editor, Admin:

```bash
php artisan migrate --seed
```
Criar link simbolico para pasta publica onde ficará as imagens

```bash
php artisan storage:link
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
