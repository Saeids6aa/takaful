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
        $camps = DB::table('camps')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return view('Home.home', compact('camps'));
    }

    public function login()
    {
        return view('home.login');
    }


  public function camps_name()
{
    $rows = DB::table('camps')
        ->select('id', DB::raw('name '))
        ->orderBy('name')
        ->get();

    return response()->json([
        'results' => $rows
    ]);
}

}