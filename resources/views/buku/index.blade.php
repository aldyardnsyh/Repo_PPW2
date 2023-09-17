<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Daftar Buku</h1>
        <div class="table-responsive mx-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Harga</th>
                        <th>Tanggal Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_buku as $buku)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.' )}}</td>
                            <td>{{ $buku->tgl_terbit }}</td>
                            <td>
                                <a href="#" class="btn btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="#" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="#" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Jumlah semua buku dan total harga semua buku -->
        <div class="row">
            <div class="col-md-6">
                <strong>Jumlah Semua Buku: {{ $count }}</strong>
            </div>
            <div class="col-md-6">
                <strong>Total Harga Semua Buku: {{ "Rp ".number_format($total, 2, ',', '.' )}}</strong>
            </div>
        </div>
    </div>
    <!-- Tambahkan link ke Bootstrap JS dan jQuery jika Anda menggunakan Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
