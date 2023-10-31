<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(){
        $batas = 5;
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() -1);
        $jumlah_buku = Buku::count();
        $total = Buku::sum('harga');
        return view('Buku.index', compact('data_buku', 'no','jumlah_buku','total'));
    }
    public function create(){
        return view('Buku.create');    
    }
    public function store(Request $request){
        $this->validate($request,[
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ]);
        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Simpan');
    }
    
    public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('hapus', 'Data berhasil dihapus');
    }

    public function edit($id){
        $buku = Buku::find($id);
        return view('Buku.edit', compact('buku'));

    }
    public function update(Request $request, $id){
        $buku = Buku::find($id);
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();
    
        return redirect('/buku')->with('success', 'Data berhasil diubah');
    }

    public function search(Request $request){
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis','like',"%".$cari."%")
        ->simplePaginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() -1);
        $total = Buku::sum('harga');
        return view('Buku.search', compact('data_buku', 'no','jumlah_buku','total','cari'));
    }
}
