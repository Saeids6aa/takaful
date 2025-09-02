<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Doner;
use App\Models\Giving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class givingsController extends Controller
{
public function index()
    {
        return view('dashboard.givings.index');
    }
    public function AjaxDT(Request $request)
    {
        if (request()->ajax()) {
            $givings  = DB::table('givings')
                    ->leftJoin('categories', 'categories.id', '=', 'givings.category_id')
            ->leftJoin('doners',     'doners.id',     '=', 'givings.doner_id');

            $givings->select(
                'givings.id',
                         'givings.name',
                         'givings.quantity',
                         DB::raw("DATE_FORMAT(givings.created_at,'%Y-%m-%d') as Date"),
                         'categories.name as category_name',
                         'doners.name     as doner_name',
            )->orderBy('givings.id', 'desc')->get();

            return DataTables::of($givings)
                ->addColumn('actions', function ($givings) {
                    return '<a href="/dashboard/givings/edit/' . $givings->id . '" data-id="' . $givings->id . '" title="تعديل بيانات العطاء ' . ($givings->name) . '" class="Popup" data-toggle="modal"><i class="la la-edit icon-xl" style="color:blue;padding:4px"></i></a>
                        <a href="/dashboard/givings/delete/' . $givings->id . '" data-id="' . $givings->id . '"   data-name="' . htmlspecialchars($givings->name) . '"   class="ConfirmLink "' . ' id="' . $givings->id . '"><i class="fa fa-trash-alt icon-md" style="color:red"></i></a>';})
                ->editColumn('category_name', function ($givings) {return "<span class='badge badge-info'>$givings->category_name </span>";})
                    ->editColumn('doner_name', function ($givings) {return ($givings->doner_name == null) ? "لا يوجد ممول  تابع له" : "<span>$givings->doner_name </span>";
                })->rawColumns(['actions', 'category_name', 'doner_name'])->make(true);
        }
    }




    public function create()
    {
        $categories = Category::select('id','name')->orderBy('name')->get();
        $doners     = Doner::select('id','name')->orderBy('name')->get();
        return view('dashboard.givings.create', compact('categories','doners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|min:2|max:255',
            'quantity'    => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'doner_id'    => 'required|exists:doners,id',
        ]);

        Giving::create($request->only('name','quantity','category_id','doner_id'));

        return response()->json(['status'=>1, 'msg'=>'تمت إضافة العطاء بنجاح']);
    }

    public function edit($id)
    {
        $giving     = Giving::findOrFail($id);
        $categories = Category::select('id','name')->orderBy('name')->get();
        $doners     = Doner::select('id','name')->orderBy('name')->get();

        return view('dashboard.givings.edit', compact('giving','categories','doners'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|min:2|max:255',
            'quantity'    => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'doner_id'    => 'required|exists:doners,id',
        ],
    [
                 'name.required' => 'الاسم مطلوب',
                'name.string' => 'الاسم يجب ان يكون نص',
                'name.min' => 'الاسم يجب ان يكون علي الاقل 2 احرف',
                'name.max' => 'الاسم يجب ان لا يتعدي 255 حرف',
                'quantity.required' => 'الكمية مطلوبة',
                'quantity.integer' => 'الكمية يجب ان تكون رقم',
                'quantity.min' => 'اقل كمية  يجب ان تكون 1',
                'category_id.required' => 'تحديد الفئة مطلوب',
                'doner_id.required' => 'تحديد الممول مطلوب',




    ]);

        $giving = Giving::findOrFail($id);
        $giving->update($request->only('name','quantity','category_id','doner_id'));

        return response()->json(['status'=>1, 'msg'=>'تم تحديث بيانات العطاء بنجاح']);
    }

    public function delete($id)
    {
        Giving::findOrFail($id)->delete();
        return response()->json(['status'=>1, 'msg'=>'تم حذف العطاء بنجاح']);
    }}
