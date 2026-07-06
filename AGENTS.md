# micro-yii2

Yii2 micro-framework RESTful API with SQLite.

## Quick start

```bash
composer install
php -S 127.0.0.1:8080 -t . index.php
```

## Routing

Routes are `/diaries` and `/diaries/{id}` (not `/diary/diaries`).
- `defaultRoute => 'diary/diaries'` handles root `/`
- `controllerMap` maps `diaries` to `diary\modules\diary\controllers\DiariesController`
- `enableStrictParsing` is commented out — leave it off

## Architecture

```
app/
  config/api.php          # Main config: db, urlManager, modules
  modules/diary/
    Module.php            # Module class, sets controllerNamespace
    controllers/
      DiariesController.php  # REST ActiveController, CORS, JSON only
    models/
      Diary.php          # ActiveRecord, fields: id, name, telephone
  database/
    diary.db             # SQLite database (table: diary)
index.php                 # Entry point — use as PHP server router script
```

## Key facts

- **Database**: SQLite at `app/database/diary.db`. DSN uses alias `@diary` resolved in config.
- **PSR-4**: `diary\` maps to `app/` (not `src/`).
- **PHP built-in server**: Must include `index.php` as router script, otherwise pretty URLs return 404.
- **CORS**: Configured in DiariesController behaviors. `Access-Control-Allow-Origin` only sent when request has `Origin` header (correct per spec). Exposes pagination headers.
- **JSON only**: Content negotiator forces `application/json` response format.
- **No rate limiter**: Removed from controller behaviors.
- **Model fields**: Explicitly defined in `Diary::fields()` — not all columns exposed by default.

## Gotchas

- Namespace is `diary\` (not `app\`, not `base\`). PSR-4 autoload in composer.json must match.
- `@diary` alias must be set for DSN resolution: `'@diary' => realpath(__DIR__.'/../')`.
- If adding new controllers to the module, register them in `controllerMap` in api.php.
- `enableStrictParsing` + `defaultRoute` conflict — don't enable strict parsing without adding explicit route rules.
