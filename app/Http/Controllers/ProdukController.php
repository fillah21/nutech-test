<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use File;

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

        $produk = Produk::all();

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
            'image' => 'mimes:jpg,png'
        ]);

        try {
            $produk = new Produk;

            $produk->kategori_id = $request->kategori_id;
            $produk->nama_produk = $request->nama_produk;
            $produk->harga_beli = $request->harga_beli;
            $produk->harga_jual = $request->harga_jual;
            $produk->stok = $request->stok;

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $image_extention = $image->getClientOriginalExtension();
                $image_name = time() . "." . $image_extention;
    
                try {
                    $image->move(public_path('/image/produk'), $image_name);
                    $produk->image = $image_name;
                } catch (\Throwable $th) {
                    throw $th;
                    echo "<script>
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Image Gagal Diupload!',
                            icon: 'error'
                        });
                    </script>";        
                }
            } else {
                $produk->image = "Image.png";
            }

            $produk->save();

            echo "<script>
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Data Produk Berhasil Disimpan!',
                    icon: 'success'
                });
            </script>";
        } catch (\Throwable $th) {
            throw $th;
            echo "<script>
                Swal.fire({
                    title: 'Gagal',
                    text: 'Data Produk Gagal Disimpan!',
                    icon: 'error'
                });
            </script>";
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
            'image' => 'mimes:jpg,png'
        ]);

        try {
            $produk = Produk::find($id);

            $produk->kategori_id = $request->kategori_id;
            $produk->nama_produk = $request->nama_produk;
            $produk->harga_beli = $request->harga_beli;
            $produk->harga_jual = $request->harga_jual;
            $produk->stok = $request->stok;

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $image_extention = $image->getClientOriginalExtension();
                $image_name = time() . "." . $image_extention;

                if($produk->image != "Image.png") {
                    $path = 'image/produk/';
                    File::delete($path. $produk->image);
                }
    
                try {
                    $image->move(public_path('/image/produk'), $image_name);
                    $produk->image = $image_name;
                } catch (\Throwable $th) {
                    throw $th;
                    echo "<script>
                        Swal.fire({
                            title: 'Gagal',
                            text: 'Image Gagal Diupload!',
                            icon: 'error'
                        });
                    </script>";        
                }
            } else {
                $produk->image = $produk->image;
            }

            $produk->save();

            echo "<script>
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Data Produk Berhasil Diperbaharui!',
                    icon: 'success'
                });
            </script>";
        } catch (\Throwable $th) {
            throw $th;
            echo "<script>
                Swal.fire({
                    title: 'Gagal',
                    text: 'Data Produk Gagal Disimpan!',
                    icon: 'error'
                });
            </script>";
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
    
            if ($produk->image != "Image.png") {
                $path = '/image/produk/';
                File::delete($path. $produk->image);
            }
     
            $produk->delete();
            
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect('/produk');
    }
}