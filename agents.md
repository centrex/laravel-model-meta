# agents.md

## Agent Guidance — laravel-model-meta

### Package Purpose
Attaches arbitrary metadata (key-value pairs) to any Eloquent model polymorphically via a `HasMeta` trait. Semantically similar to `laravel-model-data` but focused on metadata (tags, attributes, settings) rather than virtual columns.

### Before Making Changes
- Read `src/Meta.php` — the `Meta` storage model
- Read `src/MetaServiceProvider.php` — how the package registers itself
- Check `src/Facades/` for the public facade API
- Review `src/Commands/` for any artisan commands that affect meta records

### Common Tasks

**Adding bulk meta operations**
- Add batch set/get methods to the trait or `Meta.php`
- Use `upsert()` for bulk inserts to avoid N+1 on batch writes
- Add tests covering the batch case

**Adding meta value casting**
- Meta values are stored as strings by default
- If adding type casting (int, bool, json), make it opt-in per key via config or method argument
- Existing stored values must remain readable after adding casting

**Adding a `getMeta` / `setMeta` helper**
- Keep method names consistent with `laravel-model-data` where possible to reduce cognitive overhead for users who use both packages

### Testing
```sh
composer test:unit        # pest
composer test:types       # phpstan
composer test:lint        # pint
```

Test polymorphic isolation — meta from one model type must not leak to another:
```php
$user->setMeta('locale', 'en');
$post->setMeta('locale', 'fr');
expect($user->getMeta('locale'))->toBe('en');
expect($post->getMeta('locale'))->toBe('fr');
```

### Safe Operations
- Adding new trait methods
- Adding nullable migration columns
- Adding model scopes on `Meta`
- Adding tests

### Risky Operations — Confirm Before Doing
- Renaming `metable_type` / `metable_id` / `key` columns
- Changing value serialization behavior
- Removing meta cascade delete (orphaned meta rows can accumulate)

### Do Not
- Conflate this package with `laravel-model-data` — keep them independently functional
- Store structured objects as meta without JSON casting — use explicit casting
- Skip `declare(strict_types=1)` in any new file
