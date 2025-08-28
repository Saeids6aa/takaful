<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{
    function index()
    {
        return view('dashboard.categories.index');
    }

    public function AjaxDT(Request $request)
    {
        if (request()->ajax()) {
            $categories = Category::select(
                'categories.id',
                'categories.name',
                'categories.created_at',
                DB::raw("DATE_FORMAT(categories.created_at,'%Y-%m-%d') as Date"),
            )->get();
            return DataTables::of($categories)
                ->addColumn('actions', function ($categories) {
                    return '<a href="/dashboard/categories/edit/' . $categories->id . '" class="Popup" data-toggle="modal"  data-id="' . $categories->id . '"title="Edit categories"><i class="la la-edit icon-xl" style="color:blue;padding:4px"></i></a>
                        <a href="/dashboard/categories/delete/' . $categories->id . '" data-id="' . $categories->id . '"   data-name="' . htmlspecialchars($categories->name) . '"   class="ConfirmLink "' . ' id="' . $categories->id . '"><i class="fa fa-trash-alt icon-md" style="color:red"></i></a>';
                })->rawColumns(['actions'])->make(true);
        }
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
           $this->validate(
            $request,
            [
                'name' => 'required|string|min:3|max:255',
              
            ]
        );       
        $created_at = Carbon::now();
        DB::insert(
            'insert into categories (name,created_at) values (?,?)',
            [$request->name, $created_at]
        );

        return response()->json(['status' => 1, "msg" => "Categroy \" $request->name \" Added Successfully"]);
    }


    function delete($id){
        dd($id);
    }
}
