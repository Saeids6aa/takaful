<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign_delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class campaign_deliveriesController extends Controller
{

  public function index()
    {
        return view('dashboard.campaign_deliveries.index');
    }

 public function AjaxDT(Request $request)
{
    if ($request->ajax()) {

        $q = DB::table('campaign_deliveries')
            ->leftJoin('campaigns', 'campaigns.id', '=', 'campaign_deliveries.campaign_id')
            ->leftJoin('families',  'families.id',  '=', 'campaign_deliveries.familiy_id')
            ->leftJoin('admins',    'admins.id',    '=', 'campaign_deliveries.admin_id')
            ->select(
       'campaign_deliveries.id',
                'campaign_deliveries.status',
                'campaign_deliveries.image',
                'campaign_deliveries.description',
                DB::raw("DATE_FORMAT(campaign_deliveries.created_at,'%Y-%m-%d') as Date"),
                'campaigns.title  as campaign_title',   // ✅ campaigns
                'families.name   as familiy_name',    // ✅ families
                'admins.name     as admin_name'
            )
            ->orderBy('campaign_deliveries.id', 'desc'); // لا تعمل get()

        return DataTables::of($q)
            // صورة مصغرة
            ->addColumn('image_thumb', function ($row) {
                if (!$row->image) return '-';
                $src = asset('uploads/campaign_deliveries/'.$row->image);
                return '<img src="'.$src.'" alt="" style="width:60px;height:60px;border-radius:8px;object-fit:cover">';
            })
            // أزرار الإجراءات
            ->addColumn('actions', function ($row) {
                $editUrl = '/dashboard/campaign_deliveries/edit/'.$row->id;
                $delUrl  = '/dashboard/campaign_deliveries/delete/'.$row->id;
                $title   = 'تعديل تسليم الحملة '.e($row->campaign_title ?? '#'.$row->id);

                return '
                    <a href="'.$editUrl.'" data-id="'.$row->id.'" title="'.$title.'" class="Popup">
                        <i class="la la-edit icon-xl" style="color:blue;padding:4px"></i>
                    </a>
                    <a href="'.$delUrl.'" data-id="'.$row->id.'" data-name="'.e($row->campaign_title).'" class="ConfirmLink" id="cd-'.$row->id.'">
                        <i class="fa fa-trash-alt icon-md" style="color:red"></i>
                    </a>';
            })
            // لو حاب تلوّن الأعمدة المعرّفة في الـ JS
            ->editColumn('campaign_title', fn($r) => $r->campaign_title ? "<span class='badge badge-info'>{$r->campaign_title}</span>" : '-')
            ->editColumn('familiy_name',  fn($r) => $r->familiy_name  ? "<span class='badge badge-secondary'>{$r->familiy_name}</span>" : '-')
            ->editColumn('admin_name',    fn($r) => $r->admin_name    ? "<span class='badge badge-light'>{$r->admin_name}</span>" : '-')

            ->rawColumns(['image_thumb','actions','campaign_title','familiy_name','admin_name']) // ✅ صحّح القائمة
            ->make(true);
    }
}

public function create()
{
    $campaigns = DB::table('campaigns')->select('id','title')->orderBy('title')->get();
    $families  = DB::table('families')->select('id','name')->orderBy('name')->get();
    $admins    = DB::table('admins')->select('id','name')->orderBy('name')->get();

    return view('dashboard.campaign_deliveries.create',
        compact('campaigns','families','admins')); // <== لازم
}

    public function store(Request $request)
    {
        $request->validate([
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

        $data = $request->only(['status','campaign_id','familiy_id','admin_id','description']);

        // رفع الصورة
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/campaign_deliveries'), $filename);
            $data['image'] = $filename;
        }

        Campaign_delivery::create($data);

        return response()->json(['status' => 1, 'msg' => 'تمت إضافة التسليم بنجاح']);
    }
public function edit($id)
{
    $row       = Campaign_delivery::findOrFail($id);
    $campaigns = DB::table('campaigns')->select('id','title')->orderBy('title')->get();
    $families  = DB::table('families')->select('id','name')->orderBy('name')->get();
    $admins    = DB::table('admins')->select('id','name')->orderBy('name')->get();

    return view('dashboard.campaign_deliveries.edit',
        compact('row','campaigns','families','admins'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'status'       => 'required|in:completed,incomplete',
            'campaign_id'  => 'required|exists:campaigns,id',
            'familiy_id'   => 'required|exists:families,id',
            'admin_id'     => 'required|exists:admins,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'  => 'nullable|string|max:5000',
        ]);

        $row = Campaign_delivery::findOrFail($id);
        $row->fill($request->only(['status','campaign_id','familiy_id','admin_id','description']));

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/campaign_deliveries'), $filename);
            $row->image = $filename;
        }

        $row->save();

        return response()->json(['status' => 1, 'msg' => 'تم تحديث التسليم بنجاح']);
    }

    public function delete($id)
    {
        Campaign_delivery::findOrFail($id)->delete();
        return response()->json(['status' => 1, 'msg' => 'تم حذف التسليم بنجاح']);
    }

}
