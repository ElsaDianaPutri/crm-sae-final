<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {


            $table->enum('source',[
                'manual',
                'moka'
            ])
            ->default('manual')
            ->after('point_didapat');



            $table->string('external_transaction_id')
                ->nullable()
                ->after('source');


        });
    }



    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {

            $table->dropColumn([
                'source',
                'external_transaction_id'
            ]);

        });
    }

};