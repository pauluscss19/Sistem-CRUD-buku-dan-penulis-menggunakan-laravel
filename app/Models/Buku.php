<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    // Menggunakan trait HasFactory untuk mendukung pembuatan data dummy
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model
    protected $table = 'buku';

    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'judul',
        'isbn',
        'penulis_id',
        'tahun_terbit',
        'jumlah_halaman',
        'harga',
        'sinopsis'
    ];

    // Mendefinisikan relasi Many-to-One dengan model Penulis
    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'penulis_id');
    }
}