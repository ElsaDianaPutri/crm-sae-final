<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {


            // Primary Key
            $table->id('id_customer');


            // Foreign Key ke tabel users
            $table->unsignedBigInteger('id_user');


            // Data Member
            $table->string('member_code')
                  ->unique();


            $table->string('nama');


            $table->string('nomor_hp')
                  ->unique();


            $table->string('email')
                  ->nullable();


            $table->date('tanggal_lahir')
                  ->nullable();


            $table->date('tanggal_daftar');


            // Loyalty Point
            $table->integer('saldo_point')
                  ->default(0);


            // Status Member
            $table->enum('status_member', [
                'aktif',
                'nonaktif'
            ])
            ->default('aktif');



            // Relasi ke users
            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->cascadeOnDelete();



            // Timestamp Laravel
            $table->timestamps();

        });
    }



    public function down(): void
    {
        Schema::dropIfExists('customers');
    }

};