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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('nim', 20)->unique();
            $table->string('nama_lengkap', 150);
            $table->string('email', 150)->unique();
            $table->string('telepon', 20)->nullable();
            $table->text('alamat')->nullable();

            $table->string('status', 10)->default('aktif');

            $table->date('tanggal_daftar');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
