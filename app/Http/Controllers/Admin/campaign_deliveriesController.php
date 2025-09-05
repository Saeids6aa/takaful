<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Campaign_delivery;
use App\Models\Family;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\UploadImageTrait;

class campaign_deliveriesController extends Controller
{
  use UploadImageTrait;
    public function index()
    {
        return view('dashboard.campaign_deliveries.index');
    }



    public function AjaxDT(Request $request)
    {
        if (request()->ajax()) {
            $deliveries = DB::table('campaign_deliveries')
                ->leftJoin('campaigns', 'campaigns.id', '=', 'campaign_deliveries.campaign_id')
                ->leftJoin('families',  'families.id',  '=', 'campaign_deliveries.familiy_id')
                ->leftJoin('admins',    'admins.id',    '=', 'campaign_deliveries.admin_id')
                ->select(
                    'campaign_deliveries.id',
                    'campaign_deliveries.status',
                    'campaign_deliveries.image',
                    'campaign_deliveries.description',
                    DB::raw("DATE_FORMAT(campaign_deliveries.created_at,'%Y-%m-%d') as Date"),
                    'campaigns.title  as campaign_title',  
                    'families.name   as familiy_name',    
                    'admins.name     as admin_name'
                )
                ->orderBy('campaign_deliveries.id', 'desc')->where('campaign_deliveries.isDelete', 0);

            return DataTables::of($deliveries)

                ->addColumn('actions', function ($camdeliveries) {
                    return ' <a href="/dashboard/campaign_deliveries/show/' . $camdeliveries->id . '"data-id="' . $camdeliveries->id . '" title=" تفاصيل التسليم للمستفيد ('.$camdeliveries->familiy_name.')"class="Popup" data-toggle="modal"><i class="la la-eye icon-xl" style="color:green;padding:4px"></i></a> 
                            <a href="/dashboard/campaign_deliveries/delete/' . $camdeliveries->id . '" data-id="' . $camdeliveries->id . '"   data-name="' . htmlspecialchars($camdeliveries->familiy_name) . '"   class="ConfirmLink" id="' . $camdeliveries->id . '"><i class="fa fa-trash-alt icon-md" style="color:red"></i></a>';
                })->rawColumns(['actions'])->make(true);
        }
    }

    public function create()
    {
        $campaigns = DB::table('campaigns')->select('id', 'title')->orderBy('title')->get();
        $families  = DB::table('families')->select('id', 'name')->orderBy('name')->get();
        $admins    = DB::table('admins')->select('id', 'name')->orderBy('name')->get();

        return view(
            'dashboard.campaign_deliveries.create',
compact('campaigns', 'families', 'admins')
        );
    }

    public function store(Request $request)
    {
        $created_at = Carbon::now();
        $imagePath = $this->saveImages($request->file('image'), 'images/campaigns/campaign_deliveries');

        $request->validate(
            [
                'status'       => 'required|in:completed,incomplete',
                'campaign_id'  => 'required|exists:campaigns,id',
                'familiy_id'   => 'required|exists:families,id',
                'admin_id'     => 'required|exists:admins,id',
                'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description'  => 'nullable|string|max:5000',
            ],
            [
                'status.max' => 'الحالة  يجب ان لا يتعدي 255 حرف',
                'campaign_id.required' => ' اسم الحملة مطلوب',
                'familiy_id.string' => ' اسم العائلة مطلوب',
                'image.mimes' => ' يجب ان تكون امتداد jpeg,png,jpg,gif',
                'image.max' => ' حجم الصورة كبير',
                'password.max' => 'الوصف كبير  يجب ان لا تتعدى 5000 احرف',
            ]
        );
        DB::insert(
            'insert into campaign_deliveries (status,campaign_id,familiy_id,admin_id,image,description,created_at) values (?,?,?,?,?,?,?)',
            [
                $request->name,
                $request->campaign_id,
                $request->familiy_id,
                $request->admin_id,
                $request->description,
                $imagePath,
                $created_at,
            ]
        );
        return response()->json(['status' => 1, "msg" => "نم اضافة الادمن \" $request->name \" بنجاح"]);
    }
  
  
  
  
    // public function edit($id)
    // {
    //     $row       = Campaign_delivery::findOrFail($id);
    //     $campaigns = DB::table('campaigns')->select('id', 'title')->orderBy('title')->get();
    //     $families  = DB::table('families')->select('id', 'name')->orderBy('name')->get();
    //     $admins    = DB::table('admins')->select('id', 'name')->orderBy('name')->get();

    //     return view(
    //         'dashboard.campaign_deliveries.edit',
    //         compact('row', 'campaigns', 'families', 'admins')
    //     );
    // }


    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'status'       => 'required|in:completed,incomplete',
    //         'campaign_id'  => 'required|exists:campaigns,id',
    //         'familiy_id'   => 'required|exists:families,id',
    //         'admin_id'     => 'required|exists:admins,id',
    //         'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'description'  => 'nullable|string|max:5000',
    //     ]);

    //     $row = Campaign_delivery::findOrFail($id);
    //     $row->fill($request->only(['status', 'campaign_id', 'familiy_id', 'admin_id', 'description']));

    //     if ($request->hasFile('image')) {
    //         $file     = $request->file('image');
    //         $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
    //         $file->move(public_path('uploads/campaign_deliveries'), $filename);
    //         $row->image = $filename;
    //     }

    //     $row->save();

    //     return response()->json(['status' => 1, 'msg' => 'تم تحديث التسليم بنجاح']);
    // }



    public function delete($id)
    {

       
            DB::table('campaign_deliveries')->where('id', $id)->update(['isDelete' => 1]);
        return response()->json(['status' => 1, 'msg' => 'تم حذف التسليم بنجاح']);
        }

public function show($id)
{
    
          $delivery = DB::table('campaign_deliveries')
        ->leftJoin('campaigns', 'campaigns.id', '=', 'campaign_deliveries.campaign_id')
        ->leftJoin('families', 'families.id', '=', 'campaign_deliveries.familiy_id')
        ->leftJoin('admins', 'admins.id', '=', 'campaign_deliveries.admin_id')
        ->select(
            'campaign_deliveries.*',
            'campaigns.title  as campaign_title',
            'families.name    as family_name',
            'admins.name      as admin_name'
        )
        ->where('campaign_deliveries.id', $id)->first();
   
        return view('dashboard.campaign_deliveries.show', compact('delivery'));
}

    }

