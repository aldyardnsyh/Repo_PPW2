<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class BukuController extends Controller
{
    public function index(){
        $data_buku = Buku::all();

        return view('Buku.index', compact('data_buku'));
    }
}
