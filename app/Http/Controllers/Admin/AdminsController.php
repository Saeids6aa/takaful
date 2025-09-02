<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminsController extends Controller
{

    function index()
    {
        return view('dashboard.admins.index');
    }
    public function AjaxDT(Request $request)
    {
        if (request()->ajax()) {
            $admins = Admin::select(
                'admins.id',
                'admins.name',
                'admins.phone',
                'admins.id_number',
                'admins.password',
                'admins.role',
                'admins.image',
                'admins.created_at',
                DB::raw("DATE_FORMAT(admins.created_at,'%Y-%m-%d') as Date"),
            )->get();
            return DataTables::of($admins)

                ->addColumn('actions', function ($admins) {
                    return '<a href="/dashboard/admins/edit/' . $admins->id . '" data-id="' . $admins->id . '" title="تعديل الحملة ' . '" class="Popup" data-toggle="modal"><i class="la la-edit icon-xl" style="color:blue;padding:4px"></i></a>
                          <a href="/dashboard/admins/delete/' . $admins->id . '" data-id="' . $admins->id . '"   data-name="' . htmlspecialchars($admins->name) . '"   class="ConfirmLink "' . ' id="' . $admins->id . '"><i class="fa fa-trash-alt icon-md" style="color:red"></i></a>';
                })->rawColumns(['actions'])->make(true);
        }
    }
    public function create()
    {
        return view('dashboard.admins.create');
    }
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'       => 'required|string|min:3|max:255',
                'phone'      => 'required|numeric|unique:admins,phone',
                'id_number'  => 'required|numeric|unique:admins,id_number',
                'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'role'       => 'required|in:super_admin,doner,field_staff',
                'password'   => 'nullable|string|min:3|max:8|confirmed',

            ],
            [
                'name.required' => 'الاسم مطلوب',
                'name.string' => 'الاسم يجب ان يكون نص',
                'name.min' => 'الاسم يجب ان يكون علي الاقل 3 احرف',
                'name.max' => 'الاسم يجب ان لا يتعدي 255 حرف',
                'phone.required' => ' الهاتف مطلوب',
                'phone.numeric' => ' الهاتف يجب ان يكون رقم',
                'phone.unique' => ' الهاتف يجب ان يكون فريد',

                'id_number.required' => ' رقم الهوية مطلوب',
                'id_number.string' => ' الهاتف يجب ان يكون رقم',
                'id_number.unique' => ' الهاتف يجب ان يكون فريد',
                'image.required' => ' الصورة مطلوبة',
                'image.mimes' => ' يجب ان تكون امتداد jpeg,png,jpg,gif',
                'image.max' => ' حجم الصورة كبير',
                'role.required' => ' الصلاحية  مطلوبة',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب ان تكون علي الاقل 3 احرف',
                'password.max' => 'كلمة المرور يجب ان لا تتعدى 8 احرف',
                'password.confirmed' => 'كلمة المرور غير متطابفة ',



            ]
        );
        $created_at = Carbon::now();

        DB::insert(
            'insert into admins (name,phone,id_number,password,image,role,created_at) values (?,?,?,?,?,?,?)',
            [
                $request->name,
                $request->phone,
                $request->id_number,
                bcrypt($request->password),
                $request->image,
                $request->role,
                $created_at,
            ]
        );
        return response()->json(['status' => 1, "msg" => "نم اضافة الادمن \" $request->name \" بنجاح"]);
    }
    public function edit($id)
    {
        $Admin = Admin::findOrFail($id);
        return view('dashboard.admins.edit', compact('Admin'));
    }



    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name'       => 'required|string|min:3|max:255',
                'phone'      => 'required|numeric|unique:admins,phone',
                'id_number'  => 'required|numeric|unique:admins,id_number',
                'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'role'       => 'required|in:super_admin,doner,field_staff',
                'password'   => 'nullable|string|min:3|max:8|confirmed',

            ],
            [
                'name.required' => 'الاسم مطلوب',
                'name.string' => 'الاسم يجب ان يكون نص',
                'name.min' => 'الاسم يجب ان يكون علي الاقل 3 احرف',
                'name.max' => 'الاسم يجب ان لا يتعدي 255 حرف',
                'phone.required' => ' الهاتف مطلوب',
                'phone.numeric' => ' الهاتف يجب ان يكون رقم',
                'phone.unique' => ' الهاتف يجب ان يكون فريد',

                'id_number.required' => ' رقم الهوية مطلوب',
                'id_number.string' => ' الهاتف يجب ان يكون رقم',
                'id_number.unique' => ' الهاتف يجب ان يكون فريد',
                'image.required' => ' الصورة مطلوبة',
                'image.mimes' => ' يجب ان تكون امتداد jpeg,png,jpg,gif',
                'image.max' => ' حجم الصورة كبير',
                'role.required' => ' الصلاحية  مطلوبة',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب ان تكون علي الاقل 3 احرف',
                'password.max' => 'كلمة المرور يجب ان لا تتعدى 8 احرف',
                'password.confirmed' => 'كلمة المرور غير متطابفة ',



            ]
        );

        $Admin = Admin::findOrFail($id);
        $Admin->name = $request->name;
        $Admin->save();

        return response()->json(['status' => 1, "msg" => "Admin \"{$Admin->name}\" updated successfully",]);
    }


    function delete($id)
    {
        Admin::findOrFail($id)->delete();
        return response()->json(['status' => 1, "msg" => "Categroy deleted Successfully"]);
    }
}
