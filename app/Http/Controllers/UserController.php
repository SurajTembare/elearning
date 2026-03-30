<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function indexx()
    {
        return view('indexx');
    }

    public function about()
    {
        return view('about');
    }
}
