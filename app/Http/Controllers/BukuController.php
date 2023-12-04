<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\User;
use App\Models\BukuRating;

use App\Models\Favourite;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;



class BukuController extends Controller
{
    public function index()
    {
        $batas = 5;
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        $jumlah_buku = Buku::count();
        $total = Buku::sum('harga');
        return view('Buku.index', compact('data_buku', 'no', 'jumlah_buku', 'total'));
    }
    public function create()
    {
        return view('Buku.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);
        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        if ($request->file('thumbnail')) {
            $thumbnailFileName = time() . '-' . $request->thumbnail->getClientOriginalName();
            $thumbnailFilePath = $request->file('thumbnail')->storeAs('uploads', $thumbnailFileName, 'public');

            Image::make(storage_path() . '/app/public/uploads/' . $thumbnailFileName)
                ->fit(240, 320)
                ->save();

            $buku->filename = $thumbnailFileName;
            $buku->filepath = '/storage/' . $thumbnailFilePath;
            $buku->save();
        }

        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryFileName = time() . '_' . $file->getClientOriginalName();
                $galleryFilePath = $file->storeAs('uploads', $galleryFileName, 'public');

                $gallery = new Gallery;
                $gallery->nama_galeri = $galleryFileName;
                $gallery->path = '/storage/' . $galleryFilePath;
                $gallery->foto = $galleryFileName;
                $gallery->buku_id = $buku->id;
                $gallery->save();
            }
        }

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Simpan');
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('hapus', 'Data berhasil dihapus');
    }

    public function edit($id)
    {
        $buku = Buku::find($id);
        return view('Buku.edit', compact('buku'));
    }
    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);
        $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);

        if($request->file('thumbnail')) {
            $buku = Buku::find($id);

            $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

            Image::make(storage_path().'/app/public/uploads/'.$fileName)
                ->fit(240,320)
                ->save();

            $buku->update([
                'filename' => $fileName,
                'filepath' => '/storage/' . $filePath,
            ]);
        };

        if ($request->file('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri'   => $fileName,
                    'path'          => '/storage/' . $filePath,
                    'foto'          => $fileName,
                    'buku_id'       => $id
                ]);
            }
        }

        return redirect('/buku')->with('pesan', 'Data berhasil diupdate');
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%" . $cari . "%")->orwhere('penulis', 'like', "%" . $cari . "%")
            ->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        $total = Buku::sum('harga');
        return view('Buku.search', compact('data_buku', 'no', 'jumlah_buku', 'total', 'cari'));
    }
    public function destroyImage($buku_id, $image_id) {
        $buku = Buku::find($buku_id);
        $image = Gallery::find($image_id);

        if ($image && $buku && $image->buku_id === $buku->id) {
            $image->delete();
            return back()->with('pesan', 'Image deleted successfully');
        } else {
            return back()->with('error', 'Image not found or does not belong to the book');
        }
    }
    public function galbuku($id) {
        $bukus = Buku::find($id);
        $galeris = $bukus->galleries()->paginate(6);
        return view('buku.galeri', compact('bukus', 'galeris'));
    }

    public function details($id) {
        $buku = Buku::find($id);
        return view('buku.detail', compact('buku'));
    }

    // Metode untuk submit rating buku
    public function submitRating(Request $request, $id)
{
    $buku = Buku::find($id);

    if ($buku) {
        // Cek apakah pengguna sudah memberikan rating sebelumnya
        $userRating = $buku->ratings()->where('user_id', Auth::id())->first();

        if ($userRating) {
            // Jika sudah ada, update rating yang sudah ada
            $userRating->update(['rating' => $request->rating]);
            $message = 'Terima kasih telah mengubah rating';
        } else {
            // Jika belum ada, buat rating baru
            $buku->ratings()->create([
                'user_id' => Auth::id(),
                'rating' => $request->rating,
            ]);
            $message = 'Terima kasih telah memberikan rating';
        }

        return redirect()->back()->with('pesan', $message);
    } else {
        return back()->with('error', 'Buku tidak ditemukan');
    }
}

public function myFavouriteBooks()
{
    // Assuming the user is logged in
    $favouriteBooks = Favourite::where('user_id', Auth::id())->get();

    return view('buku.favourite', compact('favouriteBooks'));
}


// Method for adding a favourite book
public function addToFavourite($id)
{
    $buku = Buku::find($id);

    if ($buku) {
        // Check if the book is already in favourites
        $favouriteBook = Favourite::where('user_id', Auth::id())->where('buku_id', $buku->id)->first();

        if ($favouriteBook) {
            return back()->with('error', 'Buku sudah ada di daftar favorit');
        } else {
            // Add the book to favourites
            Favourite::create([
                'user_id' => Auth::id(),
                'buku_id' => $buku->id,
            ]);

            return back()->with('pesan', 'Buku berhasil ditambahkan ke daftar favorit');
        }
    } else {
        return back()->with('error', 'Buku tidak ditemukan');
    }
    }
}
