@extends('layouts.master')

@push('style')
<style>
    .image-wrapper {
        position: relative;
        display: inline-block;
    }

    .rounded-image {
        width: 200px;
        height: 200px;
        border-radius: 50%;
    }

    .edit-button {
        position: absolute;
        bottom: 0;
        right: 0;
        transform: translate(50%, 50%);
        background-color: white;
        border-radius: 50%;
    }
</style>
    
@endpush

@section('content')
    <div class="image-wrapper">
        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Gambar" class="rounded-image">

        <a href="#" class="edit-button" data-bs-toggle="modal" data-bs-target="#contoh">
            <i class="bi bi-pencil text-dark fs-5"></i>
        </a>
    </div>

    <h2 class="mt-4">{{ Auth::user()->name }}</h2>

    <div class="row g-3 align-items-center">
        <div class="col-7 me-5">
            <label for="inputPassword6" class="col-form-label">Nama Kandidat</label>
            <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" value="{{ Auth::user()->name }}" readonly>
        </div>
        <div class="col">
            <label for="inputPassword6" class="col-form-label">Posisi Kandidat</label>
            <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" value="{{ Auth::user()->position }}" readonly>
        </div>
    </div>

    
        <div class="modal fade" id="contoh" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Foto Profil</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="/profil/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Foto Profil</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFile" name="image">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="sumbit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            </div>
                        </form>
            </div>
        </div>
    

@endsection