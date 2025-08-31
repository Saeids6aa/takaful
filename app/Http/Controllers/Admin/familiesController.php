<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use App\Models\Family;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class familiesController extends Controller
{
  public function index()
    {
        return view('dashboard.families.index');
    }

    public function ajaxDT(Request $request)
    {
        abort_unless($request->ajax(), 404);

        $query = Family::with('camp:id,name')
            ->select('id','name','address','status','id_number','family_member','camp_id','created_at');

        return DataTables::of($query)
            ->addColumn('camp_name', fn($row) => $row->camp?->name ?? '-')
            ->editColumn('created_at', fn($row) => optional($row->created_at)->format('Y-m-d'))
            ->addColumn('actions', function ($row) {
                $editUrl = route('families.edit', $row->id);
                $delUrl  = route('families.delete', $row->id);
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
        $camps = Camp::select('id','name')->orderBy('name')->get();
        return view('dashboard.families.create', compact('camps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|min:3|max:255',
            'address'       => 'required|string|min:3|max:255',
            'status'        => 'required|string|min:3|max:255',
            'id_number'     => 'required|string|min:6|max:20|unique:families,id_number',
            'family_member' => 'required|integer|min:1',
            'camp_id'       => 'required|exists:camps,id',
        ]);

        Family::create($request->only('name','address','status','id_number','family_member','camp_id'));

        return response()->json(['status'=>1, 'msg'=>'تمت إضافة الأسرة بنجاح']);
    }

    public function edit($id)
    {
        $family = Family::findOrFail($id);
        $camps  = Camp::select('id','name')->orderBy('name')->get();
        return view('dashboard.families.edit', compact('family','camps'));
    }

    public function update(Request $request, $id)
    {
        $family = Family::findOrFail($id);

        $request->validate([
            'name'          => 'required|string|min:3|max:255',
            'address'       => 'required|string|min:3|max:255',
            'status'        => 'required|string|min:3|max:255',
            'id_number'     => 'required|string|min:6|max:20|unique:families,id_number,'.$family->id,
            'family_member' => 'required|integer|min:1',
            'camp_id'       => 'required|exists:camps,id',
        ]);

        $family->update($request->only('name','address','status','id_number','family_member','camp_id'));

        return response()->json(['status'=>1, 'msg'=>'تم تحديث بيانات الأسرة بنجاح']);
    }

    public function delete($id)
    {
        Family::findOrFail($id)->delete();
        return response()->json(['status'=>1, 'msg'=>'تم حذف الأسرة بنجاح']);
    }}
