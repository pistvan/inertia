# Inertia test app

## How to fire up

```bash
docker compose up -d
docker compose exec php composer install
docker compose exec php php artisan migrate
docker compose exec php php artisan db:seed
```

Open http://localhost/ in a browser, then use one of these users to log in:

* `admin@example.com` / `password`
* `user@example.com` / `password`

## Emails

Emails are sent to a mail trap service called Mailhog, which you can access on http://localhost:81/.
