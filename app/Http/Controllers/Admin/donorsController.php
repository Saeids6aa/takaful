<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class donorsController extends Controller
{
    public function index()
    {
        return view('dashboard.donors.index');
    }
    public function AjaxDT(Request $request)
    {
        if (request()->ajax()) {
            $doners = Doner::select(
                'doners.id',
                'doners.name',
                'doners.contact_phone',
                'doners.address',
                'doners.created_at',
                DB::raw("DATE_FORMAT(doners.created_at,'%Y-%m-%d') as Date"),
            )->get();
            return DataTables::of($doners)
                ->addColumn('actions', function ($doners) {
                    return '<a href="/dashboard/donors/edit/' . $doners->id . '" data-id="' . $doners->id . '" title="تعديل بيانات المتبرع ' . ($doners->name) . '" class="Popup" data-toggle="modal"><i class="la la-edit icon-xl" style="color:blue;padding:4px"></i></a>
                          <a href="/dashboard/donors/delete/' . $doners->id . '" data-id="' . $doners->id . '"   data-name="' . htmlspecialchars($doners->name) . '"   class="ConfirmLink "' . ' id="' . $doners->id . '"><i class="fa fa-trash-alt icon-md" style="color:red"></i></a>';
                })->rawColumns(['actions'])->make(true);
        }
    }



    public function create()
    {
        return view('dashboard.donors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|min:3|max:255',
            'contact_phone' => 'required|numeric|unique:doners,contact_phone',
            'address'       => 'required|string|min:3|max:255',
        ], [
            'name.required'           => 'الاسم مطلوب',
            'name.string'             => 'الاسم يجب أن يكون نصًا',
            'name.min'                => 'الاسم يجب أن يكون على الأقل 3 أحرف',
            'name.max'                => 'الاسم يجب ألا يتعدى 255 حرفًا',

            'contact_phone.required'  => 'رقم التواصل مطلوب',
            'contact_phone.numeric'   => 'رقم التواصل يجب أن يحتوي أرقامًا فقط',
            'contact_phone.digits_between' => 'طول رقم التواصل غير صحيح',
            'contact_phone.unique'    => 'رقم التواصل مستخدم مسبقًا',

            'address.required'        => 'العنوان مطلوب',
            'address.string'          => 'العنوان يجب أن يكون نصًا',
            'address.min'             => 'العنوان يجب أن يكون على الأقل 3 أحرف',
            'address.max'             => 'العنوان يجب ألا يتعدى 255 حرفًا',
        ]);
        $created_at = Carbon::now();

        DB::insert(
            'insert into doners (name,contact_phone,address,created_at) values (?,?,?,?)',
            [
                $request->name,
                $request->contact_phone,
                $request->address,
                $created_at,
            ]
        );

        return response()->json(['status' => 1, 'msg' => 'تمت إضافة المتبرّع بنجاح']);
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
            'contact_phone' => [
                'required',
                'numeric',
                Rule::unique('doners', 'contact_phone')->ignore($id),
            ],
            'address'       => 'required|string|min:3|max:255',
        ], [
            'name.required'           => 'الاسم مطلوب',
            'name.string'             => 'الاسم يجب أن يكون نصًا',
            'name.min'                => 'الاسم يجب أن يكون على الأقل 3 أحرف',
            'name.max'                => 'الاسم يجب ألا يتعدى 255 حرفًا',

            'contact_phone.required'  => 'رقم التواصل مطلوب',
            'contact_phone.numeric'   => 'رقم التواصل يجب أن يحتوي أرقامًا فقط',
            'contact_phone.digits_between' => 'طول رقم التواصل غير صحيح',
            'contact_phone.unique'    => 'رقم التواصل مستخدم مسبقًا',

            'address.required'        => 'العنوان مطلوب',
            'address.string'          => 'العنوان يجب أن يكون نصًا',
            'address.min'             => 'العنوان يجب أن يكون على الأقل 3 أحرف',
            'address.max'             => 'العنوان يجب ألا يتعدى 255 حرفًا',
        ]);

        $doner = Doner::findOrFail($id);
        $doner->name = $request->name;
        $doner->contact_phone = $request->contact_phone;
        $doner->address = $request->address;
        $doner->save();
        return response()->json(['status' => 1, 'msg' => 'تم تحديث بيانات المتبرع بنجاح']);
    }

    public function delete($id)
    {
        Doner::findOrFail($id)->delete();
        return response()->json(['status' => 1, 'msg' => 'تم حذف المتبرع بنجاح']);
    }
}
