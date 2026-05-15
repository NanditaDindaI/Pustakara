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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kategori_id')
                ->constrained('kategori')
                ->onDelete('cascade');

            $table->string('judul', 200);
            $table->string('pengarang', 150);
            $table->string('penerbit', 150);

            $table->year('tahun_terbit');

            $table->string('isbn', 30)->unique();

            $table->integer('stok_total')->default(0);
            $table->integer('stok_tersedia')->default(0);

            $table->text('deskripsi')->nullable();

            $table->string('cover_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};