<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Buku') }}
        </h2>
    </x-slot>

    <!-- Menambahkan tag style untuk CSS -->
    <style>
        /* Gaya untuk informasi buku */
        .book-info {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .book-info-p {
            font-size: 1rem;
        }

        /* Gaya untuk tombol submit rating */
        .submit-btn {
            margin-top: 20px;
            background-color: #007bff;
            /* Warna latar belakang default */
            color: #fff;
            /* Warna teks */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            /* Efek transisi saat hover */
        }

        /* Hover effect */
        .submit-btn:hover {
            background-color: #0056b3;
            /* Ganti dengan warna yang diinginkan saat tombol dihover */
        }

        /* Active (ditekan) effect */
        .submit-btn:active {
            background-color: #003366;
            /* Ganti dengan warna yang diinginkan saat tombol ditekan */
        }
    </style>

    <div class="py-5 bg-light">
        <div class="container">
            <!-- Back Button Section -->
            <div class="my-3">
                <a href="{{ url('/buku') }}" class="btn btn-secondary">Kembali</a>
            </div>
            @if ($buku)
            <h1>{{ $buku->judul }}</h1>
            <!-- Tampilkan informasi buku lainnya -->
            @else
            <p>Buku tidak ditemukan.</p>
            @endif

            @if($buku)
            <!-- Gallery Section -->
            <div class="row justify-content-around mt-4">
                @if(count($buku->galleries) > 0)
                <h4 class="h4 mt-3">Kumpulan gambar:</h4>
                @foreach ($buku->galleries as $gallery)
                <div class="col-md-4 mt-3">
                    <a href="{{ $gallery->path }}" data-lightbox="image-1" data-title="{{ $gallery->keterangan }}">
                        <img src="{{ $gallery->path }}" class="img-thumbnail rounded">
                    </a>
                </div>
                @endforeach
                @else
                <h4 class="h4 mt-3">Tidak ada gambar tersedia.</h4>
                @endif
                <hr class="my-5">
            </div>
            @endif

            @if($buku)
            <!-- Informasi Buku -->
            <div>
                <p class="book-info">Informasi Buku: </p>
                <p class="book-info-p">Penulis: {{ $buku->penulis }}</p>
                <p class="book-info-p">Harga: {{ "Rp ".number_format($buku->harga, 0, ',', '.' )}}</p>
                <p class="book-info-p">Tanggal Terbit: {{ date('d M Y', strtotime($buku->tgl_terbit)) }}</p>

                <!-- Show Rating Section -->
                <p class="book-info-p">Rating Rata-Rata: {{ number_format($buku->calculateAverageRating(), 1) ?: 'Belum Ada Rating' }}</p>
                <p class="book-info-p">Total Rating: {{ $buku->ratings->count() }}</p>
            </div>
            @endif

            
            @if($buku)
            <!-- Rating Form Section - Show only for regular users -->
            @if(Auth::check() && Auth::user()->level == 'user')
            <div class="mt-4">
                <h4 class="h4" style="font-weight: bold;">Beri atau Ubah Review</h4>
                <form action="{{ route('buku.rate', $buku->id) }}" method="post">
                    @csrf
                    <div class="form-group mt-2">
                        <label for="rating">Rating:</label>
                        <select name="rating" id="rating" class="form-control" style="max-width: 150px;">
                            @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}" {{ optional
                                ($buku->ratings->where('user_id', Auth::id())->first())->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 submit-btn">Submit Rating</button>
                </form>
                @if(Auth::check() && Auth::user()->level == 'user')
                <form action="{{ route('buku.addToFavourite', $buku->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary mt-4">Simpan ke Daftar Favorit</button>
                </form>
                @endif
            </div>
            @endif
            @endif


        </div>
    </div>
</x-app-layout>