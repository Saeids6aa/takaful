<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CampsController extends Controller
{
    public function index()
    {
        return view('dashboard.camps.index');
    }

    public function AjaxDT(Request $request)
    {
                if (request()->ajax()) {
            $camps = Camp::select(
                'camps.id',
                'camps.name',
                'camps.address',
                'camps.created_at',
                DB::raw("DATE_FORMAT(camps.created_at,'%Y-%m-%d') as Date"),
            )->get();
            return DataTables::of($camps)
                ->addColumn('actions', function ($camps) {
                    return '<a href="/dashboard/camps/edit/' . $camps->id . '" data-id="' . $camps->id . '" title="تعديل المخيم  ' . ($camps->name) . '" class="Popup" data-toggle="modal"><i class="la la-edit icon-xl" style="color:blue;padding:4px"></i></a>
                        <a href="/dashboard/camps/delete/' . $camps->id . '" data-id="' . $camps->id . '"   data-name="' . htmlspecialchars($camps->name) . '"   class="ConfirmLink "' . ' id="' . $camps->id . '"><i class="fa fa-trash-alt icon-md" style="color:red"></i></a>';
                })->rawColumns(['actions'])->make(true);
        }
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
        ],
    [
                'name.required' => 'الاسم مطلوب',
                'name.string' => 'الاسم يجب ان يكون نص',
                'name.min' => 'الاسم يجب ان يكون علي الاقل 3 احرف',
                'name.max' => 'الاسم يجب ان لا يتعدي 255 حرف',
                'address.required' => 'العنوان مطلوب',
                'address.string' => 'العنوان يجب ان يكون نص',
                'address.min' => 'العنوان يجب ان يكون علي الاقل 3 احرف',
                'address.max' => 'العنوان يجب ان لا يتعدي 255 حرف',
    ]);

     $created_at = Carbon::now();
    DB::insert(
                'insert into camps (name,address,created_at) values (?,?,?)',
                [$request->name, $request->address, $created_at]
            );
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
        ],
    [
                'name.required' => 'الاسم مطلوب',
                'name.string' => 'الاسم يجب ان يكون نص',
                'name.min' => 'الاسم يجب ان يكون علي الاقل 3 احرف',
                'name.max' => 'الاسم يجب ان لا يتعدي 255 حرف',
                  'address.required' => 'العنوان مطلوب',
                'address.string' => 'العنوان يجب ان يكون نص',
                'address.min' => 'العنوان يجب ان يكون علي الاقل 3 احرف',
                'address.max' => 'العنوان يجب ان لا يتعدي 255 حرف',
    ]);

        $camp = Camp::findOrFail($id);
        $camp->name = $request->name;
        $camp->address = $request->address;
        $camp->save();

        return response()->json(['status'=>1, 'msg'=>'تم تحديث بيانات المخيم بنجاح']);
    }

    public function delete($id)
    {
        Camp::findOrFail($id)->delete();

        return response()->json(['status'=>1, 'msg'=>'تم حذف المخيم بنجاح']);
    }
}
