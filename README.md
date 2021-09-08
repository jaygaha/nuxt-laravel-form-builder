# Form Builder using Nuxt js and Lumen in Docker

Demo of Form Template & Form GUI.

Package used for Form Builder, please visit: https://github.com/sethsandaru/vue-form-builder

Nuxt js is used for Frontend.

Lumen 8.2.4 is used for Backend API.

## Installation
```bash
$ git clone git@repos.buzzreach.co.jp:playground/nuxt-js-form-builder.git
$ cd nuxt-js-form-builder
$ docker compose up -d --build
```
Open [http://localhost:8090](http://localhost:8090) url in browser.

If you see the 502 error page, just wait a bit when `npm install && npm run dev` process will be finished (Check the status with the command `docker compose logs frontend-dynamic-forms`)

#### Nuxt
Nuxt application is available at the [http://localhost:8090](http://localhost:8090) url.

```bash
$ cd frontend
$ cp .env.example .env
```
#### MySQL
create a database first.

```bash
$ docker compose exec mysql-dynamic-forms bash
$ root@aacaabf7aeba:/# mysql -u root -p
$ Enter password: [Enter password 12345678]
$ mysql> create database forms;
```
#### Lumen
Lumen API is available at the [http://localhost:8090/api](http://localhost:8090/api) url. It also accessible via [http://localhost:8091](http://localhost:8091)

Renaming `.env` file and migrating database tables.
```bash
$ cd backend
$ cp .env.example .env
$ cd ..
$ docker compose exec backend-dynamic-forms bash
$ root@fe5aa52e94d3:/var/www/backend# php artisan migrate
```

## Required form elements
While creating `Submit` button two emiting fields `must` be filled.
`Emitting Code` and `Emitting Value` fileds should be filled with `api-save-form-data` value.
While submitting the rendered form data, form data are handled with vue method.