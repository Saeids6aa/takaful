<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Family;
use Carbon\Carbon;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AdminsController extends Controller
{
    use UploadImageTrait;

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
            )->where('admins.isDelete', 0)->get();
            return DataTables::of($admins)

                ->addColumn('actions', function ($admins) {
                    return ' <a href="/dashboard/admins/show/' . $admins->id . '"data-id="' . $admins->id . '" title="بيانات المسؤول"class="Popup" data-toggle="modal"><i class="la la-eye icon-xl" style="color:green;padding:4px"></i></a> 
                            <a href="/dashboard/admins/edit/' . $admins->id . '" data-id="' . $admins->id . '" title="تعديل صلاحيةالمسؤول ' . ($admins->name) . '" class="Popup" data-toggle="modal"><i class="la la-edit icon-xl" style="color:blue;padding:4px"></i></a>
                            <a href="/dashboard/admins/delete/' . $admins->id . '" data-id="' . $admins->id . '"   data-name="' . htmlspecialchars($admins->name) . '"   class="ConfirmLink "' . ' id="' . $admins->id . '"><i class="fa fa-trash-alt icon-md" style="color:red"></i></a>';
                })->editColumn('image', function ($campaigns) {
                    $url = asset('images/admin/admin_image/' . $campaigns->image);
                    return '<img src="' . $url . '" border="0" style="border-radius: 8px;" width="60" height="60" class="img-rounded" align="center" />';
                })->editColumn('role', function ($row) {
                    if ($row->role === 'super_admin') {
                        return '<span class="badge bg-success">المدير</span>';
                    } elseif ($row->role === 'doner') {
                        return '<span class="badge bg-primary">المانح </span>';
                    } elseif ($row->role === 'field_staff') {
                        return '<span class="badge bg-info">الموظف الميداني</span>';
                    }
                })->rawColumns(['actions', 'image', 'role'])->make(true);
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
                'phone'      => 'required|unique:admins,phone',
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
                'phone.unique' => ' الهاتف يجب ان يكون فريد',

                'id_number.required' => ' رقم الهوية مطلوب',
                'id_number.string' => ' الهاتف يجب ان يكون رقم',
                'id_number.unique' => ' الهاتف يجب ان يكون فريد',
                'image.mimes' => ' يجب ان تكون امتداد jpeg,png,jpg,gif',
                'image.max' => ' حجم الصورة كبير',
                'role.required' => ' الصلاحية  مطلوبة',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب ان تكون علي الاقل 3 احرف',
                'password.max' => 'كلمة المرور يجب ان لا تتعدى 8 احرف',
                'password.confirmed' => 'كلمة المرور غير متطابفة ',



            ]
        );

        $imagePath = $this->saveImages($request->file('image'), 'images/admin/admin_image');
        $created_at = Carbon::now();

        DB::insert(
            'insert into admins (name,phone,id_number,password,image,role,created_at) values (?,?,?,?,?,?,?)',
            [
                $request->name,
                $request->phone,
                $request->id_number,
                bcrypt($request->password),
                $imagePath,
                $request->role,
                $created_at,
            ]
        );
        return response()->json(['status' => 1, "msg" => "نم اضافة الادمن \" $request->name \" بنجاح"]);
    }
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('dashboard.admins.edit', compact('admin'));
    }



    public function update(Request $request, $id)
    {
        $Admin = Admin::findOrFail($id);

        $data = $request->validate(
            [
                'name'       => ['required', 'string', 'min:3', 'max:255'],
                'phone' => [
                    'required',
                    'regex:/^\+?[0-9]{0,13}$/',
                    Rule::unique('admins', 'phone')->ignore($Admin->id),
                ],

                'id_number'  => [
                    'required',
                    'numeric',
                    Rule::unique('admins', 'id_number')->ignore($Admin->id),
                ],
                'image'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'role'       => ['required', Rule::in(['super_admin', 'doner', 'field_staff'])],
                'password'   => ['nullable', 'string', 'min:3', 'max:8', 'confirmed'],
            ],
            [
                'role.required' => 'الصلاحية مطلوبة',
                'role.in'       => 'الصلاحية غير صحيحة',
            ],
            [
                'name.required' => 'الاسم مطلوب',
                'phone.required' => 'رقم الهاتف مطلوب',
                'phone.digits_between' => 'طول رقم الهاتف غير صحيح',
                'phone.unique' => 'رقم الهاتف مستخدم مسبقاً',
                'id_number.required' => 'رقم الهوية مطلوب',
                'id_number.numeric' => 'رقم الهوية يجب أن يحتوي أرقاماً فقط',
                'id_number.unique' => 'رقم الهوية مستخدم مسبقاً',
                'image.image' => 'الملف يجب أن يكون صورة',
                'image.mimes' => 'صيغة الصورة غير مدعومة',
                'image.max' => 'أقصى حجم للصورة 2MB',
                'role.required' => 'الدور مطلوب',
                'role.in' => 'قيمة الدور غير صحيحة',
                'password.confirmed' => 'تأكيد كلمة المرور غير مطابق',
            ]
        );

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($Admin['password']);
        }

        if ($request->hasFile('image')) {
            $filename = Str::uuid() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/admin/admin_image'), $filename);
            $data['image'] = $filename;
        } else {

            unset($data['image']);
        }

        $Admin->update($data);

        return response()->json(['status' => 1, "msg" => "تم تحديث المشرف \"{$Admin->name}\" بنجاح"]);
    }



    function delete($id)
    {
        $Admin = Admin::findOrFail($id);

        $Admin->isDelete = 1;
        $Admin->save();

        return response()->json([
            'status' => 1,
            "msg" => "تم حذف المشرف\"{$Admin->name}\"  بنجاح"
        ]);
    }


    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('dashboard.admins.show', compact('admin'));
    }



    public function approve_families()
    {
        return view('dashboard.admins.approve_families');
    }


    public function approve_families_AjaxDT(Request $request)
    {
        if (request()->ajax()) {

            $families = Family::select(
                'families.id',
                'families.name',
                'families.phone',
                'families.id_number',
                'families.address',
                'families.camp_id',
                'families.created_at',
                'families.family_member',
                'families.status',

                DB::raw("DATE_FORMAT(families.created_at,'%Y-%m-%d') as Date"),
            )->where('families.status', 'pending')->get();

            return DataTables::of($families)
                ->addColumn('camp_name', fn($row) => $row->camp?->name ?? '-')

                ->addColumn('change_status', function ($families) {
                    return '<button type="button" class="btn btn-sm btn-success active-btn" data-id="' . $families->id . '">اعتماد</button>';
                })->addColumn('change_status_to_rejected', function ($families) {

                    return '<button type="button" class="btn btn-sm btn-danger reject-btn" data-id="' . $families->id . '">رفض</button>';
                })->editColumn('status', function ($row) {
                    if ($row->status === 'approved') {
                        return '<span class="badge bg-success">معتمد</span>';
                    } elseif ($row->status === 'pending') {
                        return '<span class="badge bg-primary">قيد المعالجة</span>';
                    } elseif ($row->status === 'rejected') {
                        return '<span class="badge bg-danger">مرفوض</span>';
                    }
                })->rawColumns(['change_status', 'status', 'change_status_to_rejected'])->make(true);
        }
    }


    public function activate_family($id)
    {
        DB::beginTransaction();
        try {
            $families = DB::table('families')->where('id', $id)->first();
            if (!$families) {
                DB::rollBack();
                return response()->json(['status' => 0, 'msg' => 'families not found']);
            }
            $newStatus = $families->status == "pending" ? 'approved' : 'pending';
            DB::table('families')->where('id', $id)->update(['status' => $newStatus]);
            DB::commit();
            return response()->json(['status' => 1, 'msg' => 'families updated successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 0, 'msg' => 'families can\'t be updated', 'error' => $th->getMessage()]);
        }
    }


    public function reject_family($id)
    {
        DB::beginTransaction();
        try {
            $families = DB::table('families')->where('id', $id)->first();
            if (!$families) {
                DB::rollBack();
                return response()->json(['status' => 0, 'msg' => 'families not found']);
            }
            $newStatus = $families->status == "pending" ? 'rejected' : 'pending';
            DB::table('families')->where('id', $id)->update(['status' => $newStatus]);
            DB::commit();
            return response()->json(['status' => 1, 'msg' => 'families updated successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 0, 'msg' => 'families can\'t be updated', 'error' => $th->getMessage()]);
        }
    }
}
