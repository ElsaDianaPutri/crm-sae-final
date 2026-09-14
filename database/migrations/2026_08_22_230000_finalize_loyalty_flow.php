<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('redemptions', 'redemption_code')) {
            Schema::table('redemptions', function (Blueprint $table) {
                $table->string('redemption_code', 64)->nullable()->unique()->after('status');
            });
        }

        // Migrate existing successful records safely; future records may be pending.
        $pendingAllowed = true;
        if ($pendingAllowed) {
            Schema::table('redemptions', function (Blueprint $table) {
                $table->enum('status', ['pending', 'berhasil', 'gagal'])->default('pending')->change();
            });
        }

        if (Schema::hasColumn('transactions', 'external_transaction_id')) {
            $indexes = collect(Schema::getIndexes('transactions'));
            $exists = $indexes->contains(fn ($index) => $index['name'] === 'transactions_external_transaction_id_unique');
            if (!$exists) {
                Schema::table('transactions', function (Blueprint $table) {
                    $table->unique('external_transaction_id', 'transactions_external_transaction_id_unique');
                });
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('transactions', 'external_transaction_id')) {
            $indexes = collect(Schema::getIndexes('transactions'));
            if ($indexes->contains(fn ($index) => $index['name'] === 'transactions_external_transaction_id_unique')) {
                Schema::table('transactions', function (Blueprint $table) {
                    $table->dropUnique('transactions_external_transaction_id_unique');
                });
            }
        }

        if (Schema::hasColumn('redemptions', 'redemption_code')) {
            Schema::table('redemptions', function (Blueprint $table) {
                $table->dropUnique('redemptions_redemption_code_unique');
                $table->dropColumn('redemption_code');
            });
        }
    }
};
