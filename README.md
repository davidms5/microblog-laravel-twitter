# Laravel microblog

Este proyecto utiliza Docker para ejecutar una aplicación Laravel junto con MySQL.

## Requisitos

Antes de comenzar, asegúrese de tener instalados los siguientes programas en su sistema:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Instalación y Configuración

### 1. Configurar el Archivo `.env`

Copie el archivo de ejemplo `.env.example` y renómbrelo a `.env`:

```sh
cp .env.example .env
```

para efectos practicos, las credenciales de la base de datos estan tanto en el .env.example como en el docker-compose, si quiere cambiar las credenciales deberia tambien cambiar las que estan en el docker-compose.yml

### 2. Levantar los Contenedores

Ejecute el siguiente comando para construir y ejecutar los contenedores:

```sh
docker-compose up -d --build
```

Esto iniciará los servicios:

- **App Laravel** en `http://localhost:8000`
- **MySQL** en el puerto `3306`

### 3. Instalar Dependencias

Ejecute los siguientes comandos para instalar las dependencias de Laravel dentro del contenedor:

```sh
docker exec -it laravel_microblog composer install
```

### 4. Generar la Clave de la Aplicación

```sh
docker exec -it laravel_microblog php artisan key:generate
```

### 5. Ejecutar Migraciones

```sh
docker exec -it laravel_microblog php artisan migrate 
```

### 6. Acceder a la Aplicación

con eso ya deberia poder probar la api. mas informacion de las rutas en **arquitectura.md**
## Comandos útiles

**Detener los contenedores:**
```sh
docker-compose down
```

**Reiniciar los contenedores:**
```sh
docker-compose restart
```
**Ingresar al contenedor:**
```sh
docker exec -it laravel_app bash
```

## Notas

- Si necesita realizar otros cambios en la configuración de Docker, edite el archivo `docker-compose.yml`.
- Recuerde revisar la configuración de la base de datos en su archivo `.env`.


