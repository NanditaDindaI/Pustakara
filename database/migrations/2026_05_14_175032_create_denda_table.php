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
        Schema::create('denda', function (Blueprint $table) {
            $table->id();

            $table->foreignId('peminjaman_id')
                ->constrained('peminjaman')
                ->onDelete('cascade');

            $table->integer('jumlah_hari')->default(0);

            $table->decimal('nominal_per_hari', 10, 2)->default(0);

            $table->decimal('total_denda', 12, 2)->default(0);

            $table->string('status_bayar', 20)->default('belum_bayar');

            $table->date('tanggal_bayar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denda');
    }
};