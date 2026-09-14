# SAE CAFE ROJEL CRM — Business Rules Final

## Roles
- Admin: monitoring customers, rewards, transaction report, redemption report.
- Staff/Kasir: member lookup/scan, manual transaction, point accrual, redemption confirmation.
- Customer: member profile, QR member, point balance/history, reward browsing, pending redemption QR.

## Transaction → Point
- Manual transaction is the fallback when Moka is not integrated.
- `Rp10.000 = 1 point` using `floor(total/10000)`.
- Only completed/valid transactions add point.
- Point history is created with type `tambah`.

## Reward
- Reward status: `tersedia` / `tidak_tersedia`.
- Reward visible to customer when `status=tersedia` and `stock > 0`.
- Reward images are stored on the public disk under `storage/app/public/rewards`.
- Reward Favorite is the reward with the most successful (`berhasil`) redemptions.

## Redemption
- Customer action creates `pending` redemption with a unique `redemption_code`.
- Point and reward stock are NOT reduced at request time.
- Staff confirms the code/QR.
- Confirmation atomically:
  - reduces customer point;
  - reduces reward stock;
  - changes redemption to `berhasil`;
  - creates point history type `kurang`.
- Cancelled/failed pending redemptions do not alter point or stock.

## Moka
- Moka transactions use `source=moka` and `external_transaction_id`.
- `external_transaction_id` is unique to prevent duplicate point accrual.
- Manual transactions remain supported as fallback until a real Moka integration is enabled.

## Web security
- One web login form supports all roles.
- Admin, Staff, and Customer routes require both `auth` and role middleware.
- Inactive accounts are rejected.
- Guests are redirected to login for web routes.
- Wrong-role access returns HTTP 403 for web pages and JSON 403 for API requests.
