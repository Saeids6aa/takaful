<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
  // الصفحة الرئيسية: نمرّر قائمة المخيمات إلى الـ view
    public function index()
    {

        return view('Home.home');
    }

    public function login()
    {
        return view('Home.login');
    }




}