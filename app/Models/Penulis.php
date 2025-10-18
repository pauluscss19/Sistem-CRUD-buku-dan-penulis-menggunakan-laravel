<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    // Menggunakan trait HasFactory untuk mendukung pembuatan data dummy
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model
    protected $table = 'penulis';

    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama',
        'email',
        'biografi',
        'negara'
    ];

    // Mendefinisikan relasi One-to-Many dengan model Buku
    public function buku()
    {
        return $this->hasMany(Buku::class, 'penulis_id');
    }
}