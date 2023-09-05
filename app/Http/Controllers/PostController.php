<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method untuk menampilkan halaman
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Method untuk menampilkan form create post
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Method untuk menampilkan insert / input data ke dalam database
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Method untuk menampilkan single post / detail dari sebuah post
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Method untuk menampilkan halaman edit post
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Method untuk melakukan update data post ke database
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Method untuk menghapus data post
    }
}
