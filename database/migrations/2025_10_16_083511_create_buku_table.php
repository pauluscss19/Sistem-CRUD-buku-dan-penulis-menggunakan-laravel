<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('isbn')->unique();

            // Pastikan foreign key kompatibel dengan tipe id di tabel penulis
            $table->unsignedBigInteger('penulis_id');
            $table->foreign('penulis_id')
                  ->references('id')
                  ->on('penulis')
                  ->onDelete('cascade');

            $table->year('tahun_terbit');
            $table->integer('jumlah_halaman');
            $table->decimal('harga', 10, 2);
            $table->text('sinopsis')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
