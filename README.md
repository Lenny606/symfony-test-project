# symfony-test-project

## install packages

```
composer create-project symfony/skeleton:"7.0.*"
composer require webapp
composer require twig
composer require --dev symfony/profiler-pack
composer require --dev orm-fixtures
composer require symfony/orm-pack
composer require sensio/framework-extra-bundle


```
### Helpers + CMDs
```
symfony console list make
symfony console list doctrine
symfony console make:controller
symfony console make:entity
symfony console make:migration
symfony console make:command
symfony console doctrine:database:create
symfony console doctrine:migration:migrate
symfony console doctrine:migration:migrate --no-interaction
symfony console doctrine:migration:status

 symfony console make:user

```
loads Fixtures into dtb
```
symfony console doctrine:fixtures:load
```

### Debugging
```
symfony console debug:router
```
### DTB
```
host: mysql
user: root
```
### SLIM API
needs ext-curl installed
```
composer require slim/slim:"4.*"
composer require guzzlehttp/psr7 "^2"
composer require zircote/swagger-php
```
### Swagger
```
composer require zircote/swagger-php
```

### Setup Docker
create docker-compose.yml \
set env:
DATABASE_URL="mysql://root:root@mysql:3306//symf6-hands-on?serverVersion=mariadb-10.8.3&charset=utf8mb4" \
setup doctrine.yml :
server_version: '8.0'

docker compose exec php-fpm sh

### CSS
```
add tailwind
<script src="https://cdn.tailwindcss.com"></script>
```
