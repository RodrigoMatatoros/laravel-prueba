Un sistema CRUD para gestionar tareas con categorias, filtros, y autentificación de usuarios

## 1. Instalacion

Descargamos XAMPP o WAMPP e inicamos Apache y MySql


Abrimos la consola y vamos al proyecto

-cd example-app

Tras esto instalamos composer en la carpeta

-composer install

Ahora necesitamos instalar laravel

-composer global require laravel/installer

Migramos la base de datos

-php artisan migrate

Ejecutamos comando para instalacion de Seeds(predefinidas)

-php artisan db:seed

Iniciamos el servidor

php artisan serve

Vamos a la direccion http://localhost:8000


## CREDENCIALES DE PRUEBA 
-Usuario ==Test User
-Email == test@test.com
-Contraseña == password
