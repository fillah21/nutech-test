<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['kategori'];

    public function produk(){
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}
