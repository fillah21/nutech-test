<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Produk;
use Illuminate\Http\Request;

use App\Exports\ProduksExport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();

        $produk = Produk::filter(request(['search', 'kategori']))->paginate(10)->withQueryString();

        return view('kategori.index', ['kategori' => $kategori, 'produk' => $produk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();

        return view('kategori.create', ['kategori' => $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required|unique:produks,nama_produk',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'image' => 'image|mimes:jpg,png|file|max:100'
        ]);

        try {
            $produk = new Produk;

            $produk->kategori_id = $request->kategori_id;
            $produk->nama_produk = $request->nama_produk;
            $produk->harga_beli = $request->harga_beli;
            $produk->harga_jual = $request->harga_jual;
            $produk->stok = $request->stok;

            if($request->hasFile('image')) {
                try {
                    $produk->image = $request->file('image')->store('produk');
                } catch (\Throwable $th) {
                    Alert::error('Gagal', 'Image Gagal Diupload!');
                }
            } else {
                $produk->image = "produk/Image.png";
            }

            $produk->save();

            Alert::success('Berhasil', 'Data Produk Berhasil Disimpan!');

        } catch (\Throwable $th) {
            Alert::error('Gagal', 'Data Produk Gagal Disimpan!');
        }
        

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::all();

        $produk = Produk::find($id);

        return view('kategori.edit', ['kategori' => $kategori, 'produk' => $produk]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required|unique:produks,nama_produk,' . $id . ',id',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'image' => 'image|mimes:jpg,png|file|max:100'
        ]);

        try {
            $produk = Produk::find($id);

            $produk->kategori_id = $request->kategori_id;
            $produk->nama_produk = $request->nama_produk;
            $produk->harga_beli = $request->harga_beli;
            $produk->harga_jual = $request->harga_jual;
            $produk->stok = $request->stok;

            if($request->hasFile('image')) {
                if($produk->image != "produk/Image.png") {
                    Storage::delete($produk->image);
                }
    
                try {
                    $produk->image = $request->file('image')->store('produk');
                } catch (\Throwable $th) {
                    throw $th;
                    Alert::error('Gagal', 'Image Gagal Diupload!'); 
                }
            } else {
                $produk->image = $produk->image;
            }

            $produk->save();

            Alert::success('Berhasil', 'Data Produk Berhasil Diperbaharui!');
        } catch (\Throwable $th) {
            throw $th;
            Alert::error('Gagal', 'Data Produk Gagal Diperbaharui!');
        }

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $produk = Produk::find($id);
    
            if($produk->image != "produk/Image.png") {
                Storage::delete($produk->image);
            }
     
            $produk->delete();

            Alert::success('Berhasil', 'Data Produk Berhasil Dihapus!');
            
        } catch (\Throwable $th) {
            Alert::error('Gagal', 'Data Produk Gagal Dihapus!');
        }
        return redirect('/produk');
    }

    public function export()
    {
        return Excel::download(new ProduksExport, 'laporan.xlsx');
    }
}
