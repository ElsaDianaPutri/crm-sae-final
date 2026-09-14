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
        Schema::create('point_histories', function (Blueprint $table) {


    $table->id('id_point_history');


    $table->foreignId('id_customer')
        ->constrained('customers','id_customer')
        ->cascadeOnDelete();


    $table->integer('point');


    $table->enum('type',[

        'tambah',
        'kurang'

    ]);


    $table->string('keterangan')
        ->nullable();


    $table->timestamps();


});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('point_histories');
}
};