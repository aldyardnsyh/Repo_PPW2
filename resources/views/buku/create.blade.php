<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Tambah Buku') }}
        </h2>
    </x-slot>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            /* Gaya untuk header dengan warna yang sama dengan tombol tambah */
            .card-header {
                background-color: #17a2b8;
                color: #fff;
                text-align: center;
            }

            /* Gaya untuk alert error */
            .alert-danger {
                position: absolute;
                top: 10px;
                right: 10px;
                z-index: 99;
            }
        </style>
    </head>

    <body>
        <!-- Alert di kanan atas -->
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card" style="margin-bottom: 20px;">
                        <!-- Header dengan warna -->
                        <div class="card-header">
                            <h4>Tambah Buku</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>
                                <div class="form-group">
                                    <label for="penulis">Penulis</label>
                                    <input type="text" class="form-control" id="penulis" name="penulis" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_terbit">Tanggal Terbit</label>
                                    <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" required>
                                </div>
                                <!-- Thumbnail -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-lg font-bold mb-2" for="thumbnail">Thumbnail</label>
                                    <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                                </div>

                                <!-- Gallery -->
                                <div class="col-span-full mt-6">
                                    <label class="block text-gray-700 text-lg font-bold mb-2" for="gallery">Gallery</label>
                                    <div class="mt-2 mb-3" id="fileinput_wrapper">
                                        <a href="javascript:void(0);" id="tambah" class="btn btn-success mb-4" onclick="addFileInput()">+ Tambah</a>
                                        <script type="text/javascript">
                                            function addFileInput() {
                                                var div = document.getElementById('fileinput_wrapper');
                                                div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-2 form-control">';
                                            };
                                        </script>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                        <a href="/buku" class="btn btn-secondary ml-2">Batal</a>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahkan link ke Bootstrap JS dan jQuery jika Anda menggunakan Bootstrap -->
        <script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            // Menghilangkan alert setelah 3 detik
            setTimeout(function() {
                document.querySelector('.alert.alert-danger').style.display = 'none';
            }, 3000);
        </script>
    </body>

    </html>
</x-app-layout>