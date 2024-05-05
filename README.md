# Inertia test app

## How to fire up

```bash
docker compose up -d
docker compose exec php php artisan migrate
docker compose exec php php artisan db:seed
```

Open http://localhost/ in a browser, then use one of these users to log in:

* `admin@example.com` / `password`
* `user@example.com` / `password`
