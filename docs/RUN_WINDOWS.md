# Run on Windows

1. Extract the project.
2. Open PowerShell in the folder that contains `artisan` and `composer.json`.
3. Configure `.env` for the local MySQL database `sae_cafe_crm`.
4. Run:

```powershell
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Open: `http://127.0.0.1:8000/login`

Demo accounts:
- Admin: `adminsae` / `123456`
- Staff: `staffsae` / `123456`
- Customer: `081234567801` / `123456`

For an existing database, do not use `migrate:fresh`.

Local WhatsApp OTP mode: `WHATSAPP_MODE=log`. The OTP is written to the Laravel log and displayed only on the local OTP verification page. Production WhatsApp Business credentials/templates are intentionally not bundled.
