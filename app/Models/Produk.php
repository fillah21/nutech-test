<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'harga_beli',
        'harga_jual',
        'stok',
        'image'
    ];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ??  false, function($query, $search) {
            return $query->where('nama_produk', 'like', '%' . $search . '%');
        });

        $query->when($filters['kategori'] ?? false, function($query, $kategori) {
            return $query->whereHas('kategori', function($query) use ($kategori) {
                $query->where('kategori_id', $kategori);
            });
        });
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
