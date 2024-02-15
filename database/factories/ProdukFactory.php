<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Produk::class;


    public function definition()
    {
        return [
            'kategori_id' => Kategori::inRandomOrder()->first()->id,
            'nama_produk' => $this->faker->unique()->word,
            'harga_beli' => $this->faker->numberBetween(10000, 100000),
            'harga_jual' => $this->faker->numberBetween(11000, 120000),
            'stok' => $this->faker->numberBetween(1, 100),
            'image' => "Image.png",
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
