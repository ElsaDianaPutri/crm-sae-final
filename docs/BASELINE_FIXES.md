# Baseline Fixes

- Single web login accepts customer WhatsApp or admin/staff username.
- Existing staff demo account is normalized to staffsae / 123456 by migration.
- Customer layout now hides its drawer on desktop and only enables it on <=1024px.
- Customer dashboard/reward/transaction/profile pages use a unified responsive design aligned to the supplied Figma direction.
- No .env secrets are included in this package.

Run after extraction:
`copy .env.example .env`
`php artisan key:generate`
`php artisan migrate`
`php artisan storage:link`
`npm install`
`npm run build`
`php artisan serve`
