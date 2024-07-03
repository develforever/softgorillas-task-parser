
## Build
### Docker Compose

Build docker compose services:
```
docker-compose up -d --build
```

Verify if works:
```
docker-compose run php php --version
docker-compose run php symfony console
```

### PHPENV

Install  phpenv and set php version
```
phpenv local 8.1
```

## Run

Create file `data/recruitment-task-source.json` and then command looks like:

### Docker Compose
```
docker-compose run php symfony console app:task-parser recruitment-task-source
```

### PHPENV

```
php symfony console app:task-parser recruitment-task-source
```


## PHPCS Fixer

```
tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src --rules=no_unused_imports,@PSR12
```
