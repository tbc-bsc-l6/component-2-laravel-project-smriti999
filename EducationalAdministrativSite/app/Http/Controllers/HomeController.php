<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // This method must exist
    public function index()
    {
        return view('home'); // loads resources/views/home.blade.php
    }
}
