<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penulis extends Model
{
    use HasFactory;

    protected $table = 'penulis';

    protected $fillable = [
        'nama',
        'email',
        'biografi',
        'negara'
    ];

    // Relasi One to Many dengan Buku
    public function buku()
    {
        return $this->hasMany(Buku::class, 'penulis_id');
    }
}