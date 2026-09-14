<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('redemptions', function (Blueprint $table) {


        $table->id('id_redemption');


        $table->foreignId('id_customer')
            ->constrained('customers','id_customer')
            ->cascadeOnDelete();



        $table->foreignId('id_reward')
            ->constrained('rewards','id_reward')
            ->cascadeOnDelete();



        $table->dateTime('redeem_date');



        $table->integer('point_used');



        $table->enum('status',[

            'berhasil',
            'gagal'

        ])
        ->default('berhasil');



        $table->timestamps();


    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redemptions');
    }
};