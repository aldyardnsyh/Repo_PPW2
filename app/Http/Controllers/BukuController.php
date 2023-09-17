<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class BukuController extends Controller
{
    public function index(){
        $data_buku = Buku::all()->sortByDesc('id');
        $no = 0;
        $count = Buku::count();
        $total = Buku::sum('harga');
        return view('Buku.index', compact('data_buku', 'no','count','total'));
    }
}
