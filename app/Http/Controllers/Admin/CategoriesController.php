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
                    return '<a href="/dashboard/categories/edit/' . $categories->id . '" data-id="' . $categories->id . '" title="تعديل الفئة ' . ($categories->name) . '" class="Popup" data-toggle="modal"><i class="la la-edit icon-xl" style="color:blue;padding:4px"></i></a>
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

            ],[
                'name.required' => 'أسم الفئة مطلوب',
                'name.string' => 'أسم الفئة يجب ان يكون نص',
                'name.min' => 'أسم الفئة يجب ان يكون علي الاقل 3 احرف',
                'name.max' => 'أسم الفئة يجب ان لا يتعدي 255 حرف', 
            ]
        );
        $created_at = Carbon::now();
        DB::insert(
            'insert into categories (name,created_at) values (?,?)',
            [$request->name, $created_at]
        );

        return response()->json(['status' => 1, "msg" => "Categroy \" $request->name \" Added Successfully"]);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }



    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string|min:3|max:255',
            ]
        );

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return response()->json(['status' => 1, "msg" => "Category \"{$category->name}\" updated successfully",]);
    }


    function delete($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(['status' => 1, "msg" => "Categroy deleted Successfully"]);
    }
}
