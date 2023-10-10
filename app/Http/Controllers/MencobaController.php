<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MencobaController extends Controller
{
    //Mencoba Controller lain
    public function boomesport()
    {
        return view('boom');
    }
    public function prxesport()
    {
        return view('prx');
    }
    public function fnaticesport()
    {
        return view('fnatic');
    }
    public function fpxesport()
    {
        return view('fpx');
    }
    public function beranda()
    {
        return view('welcome');
    }

}
