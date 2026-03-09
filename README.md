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
* Laravel
* NodeJs
* Banco de dados (MySQL)

---

## Instalação

Clone o projeto:

```bash
git clone https://github.com/ademilsonsantos/pokedex
cd pokedex
```

Instale as dependências: <br>

Caso não tenha o node instalado (Opcional).
Faça o download do [aqui](https://nodejs.org/pt-br/download)

Caso não tenha o laravel instalado (Opcional).
```bash
composer global require laravel/installer
```

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

Email: <viewer|editor|admin>@example.com <br>
Senha: password

> **Atenção**
>
> É necessário o **SSL configurado corretamente**.  
> Caso contrário a chamada para a API pode retornar o erro **cURL error 60 (SSL certificate problem)**.

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
