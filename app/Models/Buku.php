<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'isbn',
        'penulis_id',
        'tahun_terbit',
        'jumlah_halaman',
        'harga',
        'sinopsis'
    ];

    // Relasi Many to One dengan Penulis
    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'penulis_id');
    }
}