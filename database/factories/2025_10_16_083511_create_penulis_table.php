<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Membuat kelas migrasi anonim yang meng-extend Migration
return new class extends Migration
{
    // Menjalankan migrasi untuk membuat tabel buku
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            // Kolom ID otomatis sebagai primary key
            $table->id();
            // Kolom judul buku (string)
            $table->string('judul');
            // Kolom penerbit (string, boleh null)
            $table->string('penerbit')->nullable();
            // Kolom tahun terbit (format tahun, boleh null)
            $table->year('tahun_terbit')->nullable();

            // Kolom foreign key untuk menghubungkan dengan tabel penulis
            $table->unsignedBigInteger('penulis_id');
            // Menetapkan foreign key dengan referensi ke kolom id pada tabel penulis, hapus data buku jika penulis dihapus
            $table->foreign('penulis_id')
                  ->references('id')
                  ->on('penulis')
                  ->onDelete('cascade');

            // Kolom timestamp untuk created_at dan updated_at
            $table->timestamps();
        });
    }

    // Membatalkan migrasi dengan menghapus tabel buku
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};