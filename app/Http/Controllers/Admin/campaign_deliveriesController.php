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
            $rows = Campaign_delivery::select(
                'campaign_deliveries.id',
                'campaign_deliveries.status',
                'campaign_deliveries.campaign_id',
                'campaign_deliveries.familiy_id',
                'campaign_deliveries.admin_id',
                'campaign_deliveries.image',
                'campaign_deliveries.created_at',
                DB::raw("DATE_FORMAT(campaign_deliveries.created_at,'%Y-%m-%d') as Date")
            )->get();

            return DataTables::of($rows)
                ->addColumn('image_thumb', function ($r) {
                    if (!$r->image) return '-';
                    $src = asset('uploads/campaign_deliveries/'.$r->image);
                    return '<img src="'.$src.'" style="width:40px;height:40px;border-radius:6px;object-fit:cover">';
                })
                ->addColumn('actions', function ($r) {
                    return '<a href="/dashboard/campaign-deliveries/edit/'.$r->id.'" class="Popup" data-id="'.$r->id.'">
                                <i class="la la-edit icon-xl" style="color:blue;padding:4px"></i>
                            </a>
                            <a href="/dashboard/campaign-deliveries/delete/'.$r->id.'" class="ConfirmLink" data-id="'.$r->id.'">
                                <i class="fa fa-trash-alt icon-md" style="color:red"></i>
                            </a>';
                })
                ->rawColumns(['image_thumb','actions'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('dashboard.campaign_deliveries.create');
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
        ]);

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
        $row = Campaign_delivery::findOrFail($id);
        return view('dashboard.campaign_deliveries.edit', compact('row'));
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
