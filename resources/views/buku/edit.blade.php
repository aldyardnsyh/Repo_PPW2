<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            /* Gaya untuk header dengan warna*/
            .card-header {
                background-color: #ffc107;
                color: #fff;
                text-align: center;
            }

        </style>
    </head>

    <body>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card" style="margin-bottom: 20px;">
                        <!-- Header dengan warna -->
                        <div class="card-header">
                            <h4>Edit Buku</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="{{$buku->judul}}">
                                </div>
                                <div class="form-group">
                                    <label for="penulis">Penulis</label>
                                    <input type="text" class="form-control" id="penulis" name="penulis" value="{{$buku->penulis}}">
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" class="form-control" id="harga" name="harga" value="{{$buku->harga}}">
                                </div>
                                <div class="form-group">
                                    <label for="tgl_terbit">Tanggal Terbit</label>
                                    <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{$buku->tgl_terbit}}">
                                </div>
                                <!-- Input file untuk mengunggah gambar buku -->
                                <div class="form-group">
                                    <label for="gambar">Thumbnail Gambar Buku</label>
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                                </div>
                                <div class="col-span-full mt-6">
                                    <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                                    <div class="mt-2" id="fileinput_wrapper">

                                    </div>
                                    <a href="javascript:void(0);" id="tambah" onclick="addFileInput()">Tambah</a>
                                    <script type="text/javascript">
                                        function addFileInput() {
                                            var div = document.getElementById('fileinput_wrapper');
                                            div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                                        };
                                    </script>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Update</button>
                                    <a href="/buku" class="btn btn-secondary ml-2">Batal</a>
                                </div>
                        </div>
                        </form>
                        <!-- Gallery -->
                        <div class="gallery_items">
                            @foreach($buku->galleries()->get() as $gallery)
                            <div class="gallery_item">
                                <img class="rounded-full object-cover object-center" src="{{ asset($gallery->path) }}" alt="" width="400" />
                                <form action="{{ route('buku.destroyImage', [$buku->id, $gallery->id]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger mt-1 mb-1" onClick="return confirm('Yakin ingin dihapus?')">Hapus</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Tambahkan link ke Bootstrap JS dan jQuery jika Anda menggunakan Bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
</x-app-layout>