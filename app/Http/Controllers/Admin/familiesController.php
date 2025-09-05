<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

            //          if ($request->filled('status')) {
            //     $query->where('families.status', '');
            // }

            return DataTables::of($query)
                ->addColumn('camp_name', fn($row) => $row->camp?->name ?? '-')
                ->addColumn('actions', function ($families) {
                    return ' <a href="/dashboard/families/show/' . $families->id . '"data-id="' . $families->id . '" title="بيانات العائلة "class="Popup" data-toggle="modal"><i class="la la-eye icon-xl" style="color:green;padding:4px"></i></a> 
                 
                    <a href="/dashboard/families/edit/' . $families->id . '" data-id="' . $families->id . '" title="    تعديل بيانات العائلة " class="Popup" data-toggle="modal"><i class="la la-edit icon-xl" style="color:blue;padding:4px"></i></a>
                            <a href="/dashboard/families/delete/' . $families->id . '" data-id="' . $families->id . '"   data-name="' . htmlspecialchars($families->name) . '"   class="ConfirmLink "' . ' id="' . $families->id . '"><i class="fa fa-trash-alt icon-md" style="color:red"></i></a>';
                })->editColumn('status', function ($row) {
                    if ($row->status === 'approved') {
                        return '<span class="badge bg-success">معتمد</span>';
                    } elseif ($row->status === 'pending') {
                        return '<span class="badge bg-primary">قيد المعالجة</span>';
                    } elseif ($row->status === 'rejected') {
                        return '<span class="badge bg-danger">مرفوض</span>';
                    }
                })->rawColumns(['actions', 'status'])->make(true);
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
                'phone' => [
                    'required',
                    'regex:/^\+?[0-9]{0,13}$/',
                ],
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

        $request->validate(
            [
                'name'          => 'sometimes|string|min:3|max:255',
                'address'       => 'sometimes|string|min:3|max:255',
                'id_number'     => 'sometimes|min:9|numeric|unique:families,id_number,' . $family->id,
                'family_member' => 'sometimes|integer|min:1',
                'camp_id'       => 'sometimes|exists:camps,id',
                'phone' => [
                    'required',
                    'regex:/^\+?[0-9]{0,13}$/',
                    Rule::unique('families', 'phone')->ignore($id),
                ],
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
                'id_number.unique'   => 'رقم الهوية مستخدم من قبل',

                'family_member.required' => 'عدد افراد الاسرة مطلوب',
                'family_member.integer'  => 'عدد افراد الاسرة يجب ان يكون رقم',
                'family_member.min'      => 'يجب ان يكون أقل عدد للاسرة 1',

                'camp_id.required' => 'المخيم مطلوب',
                'camp_id.exists'   => 'المخيم غير موجود',

                'phone.required' => 'رقم الهاتف مطلوب',
                'phone.string'   => 'رقم الهاتف يجب ان يكون نص',
                'phone.max'      => 'رقم الهاتف يجب ان لا يتعدى 20 رقم',
            ]
        );

        $family->update($request->only('name', 'address', 'status', 'id_number', 'phone', 'family_member', 'camp_id'));

        return response()->json(['status' => 1, 'msg' => 'تم تحديث بيانات الأسرة بنجاح']);
    }


    public function delete($id)
    {
        Family::findOrFail($id)->delete();
        return response()->json(['status' => 1, 'msg' => 'تم حذف الأسرة بنجاح']);
    }
    public function show($id)
    {

        $family = Family::findOrFail($id);
        return view('dashboard.families.show', compact('family'));
    }

}
