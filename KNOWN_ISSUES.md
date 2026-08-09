# Known Issues — laravel-model-meta

_Last checked: 2026-08-02_

## Failing tests

No failing tests. `composer test:unit` (`pest -p`) runs 2 tests, 4 assertions, both pass. As expected for this small polymorphic-metadata package, the suite is thin (`tests/ExampleTest.php` + `ArchTest.php`).

`composer test` halts at `test:refacto` (rector `--dry-run` exits non-zero) before `test:lint`/`test:types`/`test:unit` run in the chain, so each step was run individually below.

## Style / static-analysis debt

- `vendor/bin/pint --test` — passes clean (`{"result":"pass"}`).
- `vendor/bin/rector --dry-run` — **3 files** flagged, all the same single rule (`AddOverrideAttributeToOverriddenMethodsRector`, missing `#[\Override]`): `src/Facades/Meta.php`, `src/MetaServiceProvider.php`, `tests/TestCase.php`. Run `composer refacto` to apply.
- `vendor/bin/phpstan analyse` — **0 errors** ("No errors"). `phpstan-baseline.neon` is present but empty, so this is a genuinely clean result, not baseline-masked debt. (phpstan also printed an informational note that PHPStan 2.x is available; not an error.)

This package is otherwise clean — unlike `laravel-model-data`, the `Meta` facade (`src/Meta.php`) actually exists and matches what `MetaServiceProvider` registers.

## TODO / FIXME markers

None found (`grep -rn "TODO\|FIXME" --include="*.php" src/ config/ database/`).

## Open GitHub issues

Not checked — the `gh` CLI is not installed in this environment.
