@extends('layouts.master')

@push('style')
    <style>
        .icon-search {
            padding-left: 50px;
        }

        .input-group-text {
            position: absolute;
            left: 1px;
            top: 50%;
            transform: translateY(-50%);
        }

    </style>
@endpush


@section('content')
    <div >
        <a class="fw-bold fs-2 text-dark" style="text-decoration: none;">Daftar Produk</a>

        <div class="d-flex justify-content-between mt-5">
            <form action="">
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control icon-search" placeholder="Cari Barang" aria-label="Cari Barang" style="width: 350px">
                            <div class="input-group-append">
                              <span class="input-group-text bg-transparent border-0"><i class="bi bi-search"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col">                        
                        <select class="form-select border border-dark" aria-label="Default select example">
                            <option selected hidden>Semua</option>

                            @forelse ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                </div>                
            </form>

            <div>
                <a href="#" class="btn btn-success me-3"><img src="{{ asset('image/MicrosoftExcelLogo.png') }}" alt="" width="15"> Export Excel</a>
                <a href="/create" class="btn text-white" style="background-color: rgb(241, 59, 57);"><img src="{{ asset('image/PlusCircle.png') }}" alt="" width="15"> Tambah Produk</a>
            </div>
        </div>

        <table class="table border mt-3">
            <thead>
              <tr class="table-secondary">
                <td scope="col" class="text-center">No</td>
                <td scope="col" class="text-center">Image</td>
                <td scope="col">Nama Produk</td>
                <td scope="col">Kategori Produk</td>
                <td scope="col">Harga Beli (Rp)</td>
                <td scope="col">Harga Jual (Rp)</td>
                <td scope="col">Stok</td>
                <td scope="col">Aksi</td>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">gambar</td>
                    <td>gitar</td>
                    <td>Alat Musik</td>
                    <td>113.000</td>
                    <td>150.000</td>
                    <td>30</td>
                    <td>
                        <a href="" class="btn">
                            <img src="{{ asset('image/edit.png') }}" alt="">
                        </a>
                        <a href="" class="btn">
                            <img src="{{ asset('image/delete.png') }}" alt="">
                        </a>
                    </td>
                </tr>            
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <p>Show 10 from 50</p>
            
            <div>
                <a href="" class="btn"><</a>
                <a href="" class="btn">1</a>
                <a href="" class="btn">2</a>
                <span>...</span>
                <a href="" class="btn">5</a>
                <a href="" class="btn">></a>
            </div>
        </div>
    </div>
@endsection