<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>SIMS Web App</title>

</head>
<body>

    <div class="container">
        <h3 class="text-center mt-3 mb-5">DATA PRODUK</h3>
    
        <table class="table table-bordered" border="1">
            <thead >
                <tr>
                    <th class="text-white text-center" style="background-color: rgb(241, 59, 57);" align="center">No</th>
                    <th class="text-white" style="background-color: rgb(241, 59, 57);">Nama Produk</th>
                    <th class="text-white" style="background-color: rgb(241, 59, 57);">Kategori Produk</th>
                    <th class="text-white" style="background-color: rgb(241, 59, 57);">Harga Barang</th>
                    <th class="text-white" style="background-color: rgb(241, 59, 57);">Harga Jual</th>
                    <th class="text-white" style="background-color: rgb(241, 59, 57);">Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $produk as $key => $item)
                    <tr>
                        <td class="text-center" align="center">{{ $key + 1 }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->kategori->kategori }}</td>
                        <td>{{ number_format($item->harga_beli, 0, ',', ',') }}</td>
                        <td>{{ number_format($item->harga_jual, 0, ',', ',') }}</td>
                        <td>{{ $item->stok }}</td>
                    </tr>
                    
                @empty
                    <tr class="text-center">
                        <td colspan="6">Data Produk Kosong, Silahkan Tambahkan Produk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>