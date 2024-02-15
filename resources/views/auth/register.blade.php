<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIMS Web App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @stack('style')
  </head>
  <body>
    <div class="row align-items-center container-fluid p-0 m-0">
        <div class="col justify-content-center text-center align-items-center">
            <h4 class="mb-3"><i class="bi bi-handbag" style="color: rgb(241, 59, 57)"></i> SIMS Web App</h4>

            <h3>Register</h3>

            <div class="row mt-5">
                <div class="col-2"></div>
                <div class="col">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="masukkan email anda" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama" placeholder="masukkan nama anda" name="name" value="{{ old('name') }}" autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="masukkan password anda" name="password" value="{{ old('password') }}" autocomplete="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="konfirmasi password anda" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="password_confirmation">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control @error('position') is-invalid @enderror" id="posisi" placeholder="masukkan posisi anda" name="position" value="{{ old('position') }}" autocomplete="position">
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                          
                        <div class="d-grid gap-2">
                            <button class="btn text-white" type="submit" style="background-color: rgb(241, 59, 57)">Register</button>
                        </div>
                    </form>
                </div>
                <div class="col-2"></div>
            </div>

            <p class="mt-3">Sudah punya akun? <a href="/login">Login Disini</a></p>
        </div>

        <div class="col p-0">
            <img src="{{ asset('image/Frame 98699_2.png') }}" alt="" class="w-100">
        </div>
    </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
    @stack('script')
  </body>
</html>