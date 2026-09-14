# SAE CAFE ROJEL CRM

Integrated Laravel CRM + loyalty system for **Admin, Staff/Kasir, and Customer**.

## Business flow

1. Customer registers with name, WhatsApp number, email, password and confirmation.
2. WhatsApp OTP is simulated in local mode and written to `storage/logs/laravel.log`.
3. Customer receives a member account, member code and QR identifier.
4. Staff can find/scan a member and record a manual transaction.
5. `Rp10.000 = 1 point` is calculated automatically and recorded in point history.
6. Admin monitors customers, rewards, transaction reports and redemption reports.
7. Customer can request a reward redemption. A pending redemption code/QR is created.
8. Staff confirms the redemption; only then are points and reward stock reduced atomically.
9. Customer sees the updated point and redemption history.
10. Moka integration remains an adapter/future integration point; manual transaction is the fallback.

## Roles

- **Admin**: `adminsae` / `123456`
- **Staff/Kasir**: `staffsae` / `123456`
- **Customer demo**: `081234567801` / `123456`

> Change demo credentials before production.

## Windows setup

```powershell
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Open `http://127.0.0.1:8000/login`.

Do **not** use `php artisan migrate:fresh` on a database that already contains useful data.

## WhatsApp OTP

The included local adapter uses `WHATSAPP_MODE=log`, so no real WhatsApp credentials are required to test the registration flow. The OTP is written to the Laravel log and shown on the OTP page only in local environment.

A production WhatsApp Business/Meta adapter should replace `App\Services\WhatsAppService` once the merchant's provider credentials and approved templates are available.

## Responsive navigation

- Desktop (>= 1025px): sidebar remains open, no hamburger/X.
- Tablet/mobile (<= 1024px): sidebar becomes a drawer.
- Hamburger opens the drawer; X closes it.
- The same responsive behavior is used for Admin and Staff. Customer follows the Figma-inspired header + mobile drawer behavior.
