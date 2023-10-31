<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<script>
    // Menunggu 3 detik (3000 milidetik) dan kemudian menghilangkan alert
    setTimeout(function() {
        $('.alert').alert('close');
    }, 3000);
</script>
<style>
    /* Gaya untuk alert success */
    .alert-success {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 99;
        background-color: #28a745;
        /* Warna latar belakang untuk alert success */
        color: #fff;
        /* Warna teks untuk alert success */
        padding: 10px;
        /* Padding untuk alert success */
    }
</style>

<body>
    <div class="container mt-4">
        <!-- Alert untuk pesan "Data berhasil ditambahkan" -->
        @if(Session::has('pesan'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="position: absolute; top: 10px; right: 10px;">
            {{Session::get('pesan')}}
        </div>
        @endif
        <!-- Alert untuk pesan "Data berhasil diubah" -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <!-- Alert untuk pesan "Data berhasil di hapus" -->
        @if(session('hapus'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('hapus') }}
        </div>
        @endif
        <!-- Tombol "Tambah Buku" di pojok kanan atas -->
        <a href="{{ route('buku.create') }}" class="btn btn-info float-right mb-3">
            <i class="fas fa-add"></i> Tambah Buku
        </a>
        <form action="{{ route('buku.search')}}" method="get">
            <input type="text" name="kata" class="form-control" placeholder="Cari buku... " style="width: 30%;
            display: inline; margin-top: 10px; margin-bottom: 10px; float: left;">
        </form>
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
                        <td>{{ "Rp ".number_format($buku->harga, 0  , ',', '.' )}}</td>
                        <td>{{ date('d M Y', strtotime($buku->tgl_terbit)) }}</td>
                        <td>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Jumlah semua buku dan total harga semua buku -->
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-3">
                <strong>Jumlah Semua Buku: {{ $jumlah_buku }}</strong>
            </div>
            <div class="col-md-6">
                <strong>Total Harga Semua Buku: {{ "Rp ".number_format($total, 2, ',', '.' )}}</strong>
            </div>
        </div>
        <div>{{$data_buku->links('vendor.pagination.bootstrap-5')}}</div>
    </div>

    <!-- Tambahkan link ke Bootstrap JS dan jQuery jika Anda menggunakan Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
</x-app-layout>
