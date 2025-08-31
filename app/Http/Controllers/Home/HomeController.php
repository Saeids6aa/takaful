<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller; 
class HomeController extends Controller
{
    public function index()
    {
        return view('Home.home'); 
    }
    public function login()
    {
        return view('home.login'); 
    }

}