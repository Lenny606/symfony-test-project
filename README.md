# symfony-test-project

## install packages

```
composer create-project symfony/skeleton:"7.0.*"
composer require webapp
composer require twig
composer require --dev symfony/profiler-pack
composer require --dev orm-fixtures
composer require symfony/orm-pack
composer require symfony/orm-pack

```
### Helpers
```
symfony console list make
symfony console list doctrine
symfony console make:controller
symfony console make:entity
symfony console make:migration
symfony console doctrine:database:create
symfony console doctrine:migration:migrate
symfony console doctrine:migration:migrate --no-interaction
symfony console doctrine:migration:status
symfony console doctrine:fixtures:load

```

### Debugging
```
symfony console debug:router
```


### Setup Docker
create doceker-compose.yml \
set env:
DATABASE_URL="mysql://root:root@127.0.0.1:3306//symf6?serverVersion=mariadb-10.8.3&charset=utf8mb4" \
setup doctrine.yml :
server_version: '10.8.3'