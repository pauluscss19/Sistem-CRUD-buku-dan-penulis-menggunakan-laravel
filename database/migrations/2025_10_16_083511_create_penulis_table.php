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
            $table->string('penerbit')->nullable();
            $table->year('tahun_terbit')->nullable();

            // Foreign key ke tabel penulis
            $table->unsignedBigInteger('penulis_id');
            $table->foreign('penulis_id')
                  ->references('id')
                  ->on('penulis')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
