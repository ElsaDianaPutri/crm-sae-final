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
        Schema::create('transactions', function (Blueprint $table) {

    $table->id('id_transaction');


    $table->foreignId('id_customer')
        ->constrained('customers','id_customer')
        ->cascadeOnDelete();


    $table->string('kode_transaksi')
        ->unique();


    $table->dateTime('tanggal_transaksi');


    $table->integer('total_belanja');


    $table->integer('point_didapat')
        ->default(0);


    $table->enum('status',[
        'selesai',
        'batal'
    ])
    ->default('selesai');


    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};