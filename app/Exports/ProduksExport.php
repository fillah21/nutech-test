<?php

namespace App\Exports;

use App\Models\Produk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\WithTitle;

class ProduksExport implements FromView
{
    public function view(): View
    {
        $produk = Produk::filter(request(['search', 'kategori']))->get();

        return view('kategori.export', [
            'produk' => $produk
        ]);
    }
}
