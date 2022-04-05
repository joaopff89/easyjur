<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function home()
    {
        return view('home');
    }

    public function dicaCreate()
    {
        return view('dicaCreate');
    }

    public function dicaEdit()
    {
        return view('dicaEdit');
    }

    public function dicaShow()
    {
        return view('dicaShow');
    }
}
