@extends('layouts.master')

@push('style')
    <style>
        .drag-area {
            border: 2px dashed #0d6efd;
            height: 300px;
            border-radius: 6px;
        }

        .drag-area.active{
            border: 2px solid #0d6efd;
        }
    </style>
@endpush


@section('content')
    <div class="d-flex">
        <a href="/" class="fw-bold text-dark fs-2 text-opacity-25 me-3" style="text-decoration: none;">Daftar Produk</a>
        <p class="fw-bold fs-2 me-3">></p>
        <a href="/create" class="fw-bold text-dark fs-2 me-3" style="text-decoration: none;">Tambah Produk</a>
    </div>

    <form action="" method="post">
        <div class="row">
            <div class="d-flex">
                <div class="col-4">
                    <div class="mb-3 me-3">
                        <label for="kategori" class="form-label fw-bold">Kategori</label>
                        <select class="form-select border border-dark" aria-label="Default select example">
                            <option selected hidden>Pilih Kategori</option>

                            @forelse ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                </div>
                
                <div class="col">
                    <div class="mb-3 ms-2">
                        <label for="nama_barang" class="form-label fw-bold">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" placeholder="Masukkan nama barang">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="harga_beli" class="form-label fw-bold">Harga Beli</label>
                    <input type="number" class="form-control" id="harga_beli" placeholder="Masukkan harga beli">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="harga_jual" class="form-label fw-bold">Harga Jual</label>
                    <input type="number" class="form-control" id="harga_jual" placeholder="Masukkan harga jual">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="stok" class="form-label fw-bold">Stok Barang</label>
                    <input type="number" class="form-control" id="stok" placeholder="Masukkan jumlah stok barang">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Upload Image</label>

            <div class="drag-area text-center justify-content-center align-center pt-5" id="dragArea">
                <div id="contentWrapper">
                    <img id="previewImage" src="{{ asset('image/Image.png') }}" alt="" class="fs-1" width="100">
                    <header class="fs-5 mb-3">Upload gambar disini</header>
                    <label for="fileInput" class="btn btn-primary" id="button-image">Browse File</label>
                </div>
                <input type="file" id="fileInput" hidden>
            </div>
        
        </div> 
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="/" class="btn btn-outline-primary me-md-2" type="button">Batalkan</a>
            <button class="btn btn-primary" type="button">Simpan</button>
        </div>
    </form>
@endsection

@push('script')
    <script>
        const fileInput = document.getElementById('fileInput');
        const previewImage = document.getElementById('previewImage');
        const buttonImage = document.getElementById('button-image');
        const contentWrapper = document.getElementById('contentWrapper');
        
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            
            const url = URL.createObjectURL(file);
        
            document.getElementById('previewImage').src = url;

            previewImage.style.display = 'block';
            buttonImage.style.display = 'block';
            
            const elementsToHide = document.querySelectorAll('.drag-area *:not(#previewImage):not(#button-image)');
            
            elementsToHide.forEach(function(element) {
                element.style.display = 'none';
            });

            contentWrapper.style.display = 'inline-block';
            buttonImage.style.marginTop = '10px';
        });
    </script>
@endpush