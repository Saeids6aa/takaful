<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Doner;
use App\Models\Giving;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class givingsController extends Controller
{
public function index()
    {
        return view('dashboard.givings.index');
    }

    public function ajaxDT(Request $request)
    {
        abort_unless($request->ajax(), 404);

        $query = Giving::with(['category:id,name', 'doner:id,name'])
            ->select('id','name','quantity','category_id','doner_id','created_at');

        return DataTables::of($query)
            ->addColumn('category_name', fn($row) => $row->category?->name ?? '-')
            ->addColumn('doner_name',    fn($row) => $row->doner?->name ?? '-')
            ->editColumn('created_at',   fn($row) => optional($row->created_at)->format('Y-m-d'))
            ->addColumn('actions', function ($row) {
                $editUrl = route('givings.edit', $row->id);
                $delUrl  = route('givings.delete', $row->id);
                return '
                    <a href="'.$editUrl.'" class="Popup" data-id="'.$row->id.'" title="تعديل">
                        <i class="la la-edit icon-xl" style="color:blue;padding:4px"></i>
                    </a>
                    <a href="javascript:void(0)" class="ConfirmLink" data-method="delete"
                       data-url="'.$delUrl.'" data-id="'.$row->id.'" title="حذف">
                        <i class="fa fa-trash-alt icon-md" style="color:red"></i>
                    </a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
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
