<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class donorsController extends Controller
{
    //

    public function index()
    {
        return view('dashboard.donors.index');
    }

    public function ajaxDT(Request $request)
    {
        abort_unless($request->ajax(), 404);

        $query = Doner::select('id','name','contact_phone','address','created_at');

        return DataTables::of($query)
            ->editColumn('created_at', fn($row) => optional($row->created_at)->format('Y-m-d'))
            ->addColumn('actions', function ($row) {
                $editUrl = route('donors.edit', $row->id);
                $delUrl  = route('donors.delete', $row->id);
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
        return view('dashboard.donors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|min:3|max:255',
            'contact_phone' => 'required|string|min:6|max:20',
            'address'       => 'required|string|min:3|max:255',
        ]);

        Doner::create($request->only('name','contact_phone','address'));

        return response()->json(['status'=>1, 'msg'=>'تمت إضافة المتبرع بنجاح']);
    }

    public function edit($id)
    {
        $doner = Doner::findOrFail($id);
        return view('dashboard.donors.edit', compact('doner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|min:3|max:255',
            'contact_phone' => 'required|string|min:6|max:20',
            'address'       => 'required|string|min:3|max:255',
        ]);

        $doner = Doner::findOrFail($id);
        $doner->update($request->only('name','contact_phone','address'));

        return response()->json(['status'=>1, 'msg'=>'تم تحديث بيانات المتبرع بنجاح']);
    }

    public function delete($id)
    {
        Doner::findOrFail($id)->delete();
        return response()->json(['status'=>1, 'msg'=>'تم حذف المتبرع بنجاح']);
    }
}


