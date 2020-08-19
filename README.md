# Template Laravel (Backend)

## Docs
[PostManCollection](https://documenter.getpostman.com/view/8298242/T1Dv7Eah?version=latest "PostManCollection")

## Install
### Docker
```bash
echo -e "$(cat .env.example)\n$(cat .env.docker)" >> .env \
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
## Use
### Docker commands start, stop, restart
```bash
docker-compose <command> && docker-compose logs -f
```
### Login
```bash
login: superadmin@gmail.com
pass: superadmin
```
