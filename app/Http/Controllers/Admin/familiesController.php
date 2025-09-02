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
        if (request()->ajax()) {

            $query = Family::with('camp:id,name')
                ->select('id', 'name', 'address', 'status', 'id_number', 'family_member', 'camp_id', 'created_at');

            return DataTables::of($query)
                ->addColumn('camp_name', fn($row) => $row->camp?->name ?? '-')
                ->editColumn('created_at', fn($row) => optional($row->created_at)->format('Y-m-d'))
                ->addColumn('actions', function ($row) {
                    $editUrl = route('families.edit', $row->id);
                    $delUrl  = route('families.delete', $row->id);
                    return '
                    <a href="' . $editUrl . '" class="Popup" data-id="' . $row->id . '" title="تعديل">
                        <i class="la la-edit icon-xl" style="color:blue;padding:4px"></i>
                    </a>
                    <a href="javascript:void(0)" class="ConfirmLink" data-method="delete"
                       data-url="' . $delUrl . '" data-id="' . $row->id . '" title="حذف">
                        <i class="fa fa-trash-alt icon-md" style="color:red"></i>
                    </a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    public function create()
    {
        $camps = Camp::select('id', 'name')->orderBy('name')->get();
        return view('dashboard.families.create', compact('camps'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'          => 'required|string|min:3|max:255',
                'address'       => 'required|string|min:3|max:255',
                'id_number'     => 'required|min:9|numeric|unique:families,id_number',
                'family_member' => 'required|integer|min:1',
                'camp_id'       => 'required|exists:camps,id',
                'phone'         => 'required|string|max:20',
            ],
            [
                'name.required' => 'الاسم مطلوب',
                'name.string'   => 'الاسم يجب ان يكون نص',
                'name.min'      => 'الاسم يجب ان يكون علي الاقل 3 احرف',
                'name.max'      => 'الاسم يجب ان لا يتعدي 255 حرف',

                'address.required' => 'العنوان مطلوب',
                'address.string'   => 'العنوان يجب ان يكون نص',
                'address.min'      => 'العنوان يجب ان يكون علي الاقل 3 احرف',
                'address.max'      => 'العنوان يجب ان لا يتعدي 255 حرف',

                'id_number.required' => 'رقم الهوية مطلوب',
                'id_number.numeric'  => 'رقم الهوية يجب ان يكون أرقام فقط',
                'id_number.unique'   => 'رقم الهوية يجب ان يكون فريد',

                'family_member.required' => 'عدد افراد الاسرة مطلوب',
                'family_member.integer'  => 'عدد افراد الاسرة يجب ان يكون رقم',
                'family_member.min'      => 'يجب ان يكون أقل عدد للاسرة 1',

                'camp_id.required' => 'المخيم مطلوب',
                'camp_id.exists'   => 'المخيم غير موجود',
            ]
        );

        $data = $request->only(['name', 'address', 'id_number', 'family_member', 'camp_id', 'phone']);

        Family::create($data);

        return response()->json(['status' => 1, 'msg' => 'تمت إضافة الأسرة بنجاح']);
    }

    public function edit($id)
    {
        $family = Family::findOrFail($id);
        $camps  = Camp::select('id', 'name')->orderBy('name')->get();
        return view('dashboard.families.edit', compact('family', 'camps'));
    }

    public function update(Request $request, $id)
    {
        $family = Family::findOrFail($id);

        $request->validate([
            'name'          => 'required|string|min:3|max:255',
            'address'       => 'required|string|min:3|max:255',
            'id_number'     => 'required|numeric|unique:families,id_number,' . $family->id,
            'family_member' => 'required|integer|min:1',
            'camp_id'       => 'required|exists:camps,id',
        ]);

        $family->update($request->only('name', 'address', 'status', 'id_number', 'family_member', 'camp_id'));

        return response()->json(['status' => 1, 'msg' => 'تم تحديث بيانات الأسرة بنجاح']);
    }


    public function delete($id)
    {
        Family::findOrFail($id)->delete();
        return response()->json(['status' => 1, 'msg' => 'تم حذف الأسرة بنجاح']);
    }
}
