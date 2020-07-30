# Template Laravel (Backend)

## Install

### Composer
```bash
composer install \
&& composer run-script post-root-package-install \
&& composer run-script post-create-project-cmd

sudo chmod -R 777 bootstrap/ storage/ vendor/
```

### Docker
```bash
echo -e "\n$(cat .env.docker)" >> .env \
&& docker-compose up --build
```

### Add string host's file
```bash
...
127.0.0.1 api.template-laravel.loc www.api.template-laravel.loc
```

### Migrate and Seeding
```bash
docker-compose exec php bash
php artisan migrate:fresh --seed
```
