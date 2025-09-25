## Crear un proyecto
````bash
composer create-project laravel/laravel nou-projecte-laravel
````

## Instalar las dependencias para API
````bash
php artisan install:api
````

## Instalar la key necesaria
````bash
php artisan key:generate
````

## Instalar dependencias 
````bash
composer install
````

## Levantar el servidor de desarrollo
````bash
php artisan serve
````

## Ejecutar migraciones
````bash
php artisan migrate
````

## Crear una migracrón
````bash
php artisan make:migration nombre_migracion
````
## Ejecutar seeders
````bash
php artisan db:seed
````
## Limpiar cachés
````bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
````
