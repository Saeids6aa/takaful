<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CampsController extends Controller
{
    public function index()
    {
        return view('dashboard.camps.index');
    }

    public function ajaxDT(Request $request)
    {
        abort_unless($request->ajax(), 404);

        $query = Camp::select('id','name','address','created_at');

        return DataTables::of($query)
            ->editColumn('created_at', fn($row) => optional($row->created_at)->format('Y-m-d'))
            ->addColumn('actions', function ($row) {
                $editUrl = route('camps.edit', $row->id);
                $delUrl  = route('camps.delete', $row->id);
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
        return view('dashboard.camps.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|min:3|max:255',
            'address' => 'required|string|min:3|max:255',
        ]);

        Camp::create($request->only('name','address'));

        return response()->json(['status'=>1, 'msg'=>'تمت إضافة المخيم بنجاح']);
    }

    public function edit($id)
    {
        $camp = Camp::findOrFail($id);
        return view('dashboard.camps.edit', compact('camp'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|min:3|max:255',
            'address' => 'required|string|min:3|max:255',
        ]);

        $camp = Camp::findOrFail($id);
        $camp->update($request->only('name','address'));

        return response()->json(['status'=>1, 'msg'=>'تم تحديث بيانات المخيم بنجاح']);
    }

    public function delete($id)
    {
        Camp::findOrFail($id)->delete();
        return response()->json(['status'=>1, 'msg'=>'تم حذف المخيم بنجاح']);
    }
}
