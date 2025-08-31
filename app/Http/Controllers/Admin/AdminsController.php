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
        return view('dashboard.Admins.index');
    }
    public function AjaxDT(Request $request)
    {
        if (request()->ajax()) {
            $Admins = Admin::select(
                'Admins.id',
                'Admins.name',
                'Admins.phone',
                'Admins.id_number',
                'Admins.password',
                'Admins.role',
                'Admins.image',
                'Admins.created_at',
                DB::raw("DATE_FORMAT(Admins.created_at,'%Y-%m-%d') as Date"),
            )->get();
            return DataTables::of($Admins)
                ->addColumn('actions', function ($Admins) {
                    return '<a href="/dashboard/Admins/edit/' . $Admins->id . '" data-id="' . $Admins->id . '" data-name="' . htmlspecialchars($Admins->name) . '" class="Popup" data-toggle="modal"><i class="la la-edit icon-xl" style="color:blue;padding:4px"></i></a>
                        <a href="/dashboard/Admins/delete/' . $Admins->id . '" data-id="' . $Admins->id . '"   data-name="' . htmlspecialchars($Admins->name) . '"   class="ConfirmLink "' . ' id="' . $Admins->id . '"><i class="fa fa-trash-alt icon-md" style="color:red"></i></a>';
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
                'name' => 'required|string|min:3|max:255',
                'phone' => 'required|intagar|unique:adminss,',
                'id_number'=>'required|intagar|unique:admins,',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'role' => 'required|in:super_admin,doner,field_staff',
                'password' => 'nullable|string|min:3|max:8|confirmed',


            ]
        );
        $created_at = Carbon::now();
        DB::insert(
            'insert into Admins (name,phone,id_number,password,image,role,created_at) values (?,?)',
            [
                $request->name,
                $request->phone,
                $request->id_number,
                bcrypt($request->password),
                $request->image,
                $request->role,
                $created_at
            ]
        );

        return response()->json(['status' => 1, "msg" => "Admin \" $request->name \" Added Successfully"]);
    }
//     public function edit($id)
//     {
//         $Admin = Admin::findOrFail($id);
//         return view('dashboard.Admins.edit', compact('Admin'));
//     }
//     public function update(Request $request, $id)
//     {
//    $this->validate(
//             $request,
//             [
//                 'name' => 'required|string|min:3|max:255',
//                 'phone' => 'required|intagar|unique:admins,email,',
//                 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//                 'role' => 'required|in:admin,funder,field',
//                 'password' => 'nullable|string|min:3|max:8|confirmed',


//             ]
//         );

//         $Admin = Admin::findOrFail($id);
//         $Admin->name = $request->name;
//         $Admin->save();

//         return response()->json(['status' => 1, "msg" => "Admin \"{$Admin->name}\" updated successfully",]);
//     }
}
