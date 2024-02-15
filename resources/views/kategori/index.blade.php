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
    <div>
        <a class="fw-bold fs-2 text-dark" style="text-decoration: none;">Daftar Produk</a>

        <div class="d-flex justify-content-between mt-5">

            <form action="/" id="searchForm">
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control icon-search" placeholder="Cari Barang" aria-label="Cari Barang" style="width: 350px" name="search" value="{{ request('search') }}">
                            <div class="input-group-append">
                              <span class="input-group-text bg-transparent border-0"><i class="bi bi-search"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col">                        
                        <select id="kategoriSelect" class="form-select border border-dark" aria-label="Default select example" name="kategori">
                            <option selected hidden value="">Semua</option>

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
                <a href="/produk/create" class="btn text-white" style="background-color: rgb(241, 59, 57);"><img src="{{ asset('image/PlusCircle.png') }}" alt="" width="15"> Tambah Produk</a>
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
                @forelse ($produk as $key => $prod)
                    <tr class="align-center">
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td class="text-center">
                            <img src="{{ asset('image/produk/' . $prod->image) }}" alt="" width="50">
                        </td>
                        <td>{{ $prod->nama_produk }}</td>
                        <td>{{ $prod->kategori->kategori }}</td>
                        <td>{{ number_format($prod->harga_beli, 0, ',', '.') }}</td>
                        <td>{{ number_format($prod->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $prod->stok }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="/produk/{{ $prod->id }}/edit" class="btn">
                                    <img src="{{ asset('image/edit.png') }}" alt="">
                                </a>
                                <form id="deleteForm{{ $prod->id }}" action="/produk/{{ $prod->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn delete-button" data-id="{{ $prod->id }}">
                                        <img src="{{ asset('image/delete.png') }}" alt="">
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>            
                @empty
                    <tr class="text-center">
                        <td colspan="8">Data Produk Kosong, Silahkan Tambahkan Produk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        
        
        {{ $produk->links() }}
    </div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function () {
                const productId = button.getAttribute('data-id');
                
                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus data?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus saja!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm' + productId).submit();
                    }
                });
            });
        });
    });

    $(document).ready(function() {
        $(document).ready(function() {
        $('select[name="kategori"]').on('change', function() {
            $('#searchForm').submit();
        });
    });
    });
</script>
@endpush