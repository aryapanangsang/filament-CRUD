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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('no_register')->nullable();  
            $table->string('name');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('gender',['Laki-laki','Perempuan'])->nullable();
            $table->string('alamat')->nullable();
            $table->string('domisili')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_hp_darurat')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->enum('kantor_tujuan',['Cikarang','Purwakarta'])->nullable();
            $table->string('email')->unique();
            $table->string('path')->nullable();
            $table->string('role')->default('Member');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
