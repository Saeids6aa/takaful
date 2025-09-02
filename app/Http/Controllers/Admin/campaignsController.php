<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Camp;
use App\Models\Campaign;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class campaignsController extends Controller
{
    public function index()
    {
        return view('dashboard.campaigns.index');
    }

    public function AjaxDT(Request $request)
    {
        if (request()->ajax()) {
            $campaigns  = DB::table('campaigns')
                ->join('categories', 'categories.id', '=', 'campaigns.category_id')
                ->join('admins', 'admins.id', '=', 'campaigns.admin_id')
                ->leftJoin('camps', 'camps.id', '=', 'campaigns.camp_id');

            $campaigns->select(
                'campaigns.id',
                'campaigns.title',
                'campaigns.quantity',
                'campaigns.status',
                'campaigns.created_at',
                'categories.name as categoryName',
                'admins.name as adminName',
                'camps.name as campName',
                DB::raw("DATE_FORMAT(campaigns.created_at,'%Y-%m-%d') as Date"),
            )->orderBy('campaigns.id', 'desc')->where('campaigns.isDelete', 0)->get();

            return DataTables::of($campaigns)
                ->addColumn('actions', function ($campaigns) {
                    return '<a href="/dashboard/campaigns/edit/' . $campaigns->id . '" data-id="' . $campaigns->id . '" title="تعديل الحملة ' . ($campaigns->title) . '" class="Popup" data-toggle="modal"><i class="la la-edit icon-xl" style="color:blue;padding:4px"></i></a>
                        <a href="/dashboard/campaigns/delete/' . $campaigns->id . '" data-id="' . $campaigns->id . '"   data-name="' . htmlspecialchars($campaigns->title) . '"   class="ConfirmLink "' . ' id="' . $campaigns->id . '"><i class="fa fa-trash-alt icon-md" style="color:red"></i></a>';
                })->editColumn('adminName', function ($campaigns) {
                    return "<span class='badge badge-info'>$campaigns->adminName </span>";
                })->editColumn('status', function ($row) {
                    if ($row->status === 'Inprogress') {
                        return '<span class="badge bg-primary">قيد العمل</span>';
                    } elseif ($row->status === 'Finished') {
                        return '<span class="badge bg-success">مكتملة</span>';
                    }
                })->editColumn('campName', function ($campaigns) {
                    return ($campaigns->campName == null) ? "لا يوجد مخيم تابع له" : "<span class='badge badge-light-primary'>$campaigns->campName </span>";
                })->rawColumns(['actions', 'adminName', 'campName', 'status'])->make(true);
        }
    }

    

    public function create()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $camps     = Camp::select('id', 'name')->orderBy('name')->get();

        return view('dashboard.campaigns.create', compact('categories', 'camps'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title'       => 'required|string|min:3|max:255',
                'description' => 'required|string|max:265|min:6',
                'category_id' => 'required|exists:categories,id',
                'camp_id' => 'required|exists:camps,id',
                'quantity' => 'required|numeric'
            ],
            [
                'title.required' => 'العنوان مطلوب',
                'title.string' => 'العنوان يجب ان يكون نص',
                'title.min' => 'العنوان يجب ان يكون علي الاقل 3 احرف',
                'title.max' => 'العنوان يجب ان لا يتعدي 255 حرف',
                'description.required' => 'الوصف مطلوب',
                'description.string' => 'الوصف يجب ان يكون نص',
                'description.min' => 'الوصف يجب ان يكون علي الاقل 3 احرف',
                'description.max' => 'الوصف يجب ان لا يتعدي 255 حرف',
                'category_id.required' => 'الفئة مطلوبة',
                'camp_id.required' => 'المخيم مطلوب',
                'quantity.required' => 'المخيم مطلوب',
            ]
        );

        $created_at = Carbon::now();
        $admin_id = 1;

        $stock = DB::table(table: 'givings')
            ->where('category_id', $request->category_id)->sum('quantity');

        if ($request->quantity > $stock) {
            return response()->json(['status' => 0, 'msg' => 'الكمية المطلوبة أكبر من المتاح بالمخزن.']);
        } else {

            DB::insert(
                'insert into campaigns (title,description,category_id,camp_id,quantity,admin_id,created_at) values (?,?,?,?,?,?,?)',
                [$request->title, $request->description, $request->category_id, $request->camp_id, $request->quantity, $admin_id, $created_at]
            );
            DB::table('givings')
                ->where('category_id', $request->category_id)
                ->decrement('quantity', $request->quantity);

            return response()->json(['status' => 1, 'msg' => 'تم إضافة الحملة بنجاح']);
        }
    }

    public function edit($id)
    {
        $campaign   = Campaign::where('id', $id)->first();
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $admins     = Admin::select('id', 'name')->orderBy('name')->get();
        $camps     = Camp::select('id', 'name')->orderBy('name')->get();

        return view('dashboard.campaigns.edit', compact('campaign', 'categories', 'admins', 'camps'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:5000',
            'category_id' => 'required|exists:categories,id',
            'camp_id'     => 'required|exists:camps,id',
            'quantity'    => 'nullable|integer|min:1',
        ], [
            'title.required'   => 'العنوان مطلوب',
            'category_id.required' => 'الفئة مطلوبة',
            'camp_id.required'     => 'المخيم مطلوب',
        ]);


        $campaign = Campaign::findOrFail($id);
        $campaign->update([
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'camp_id'     => $request->input('camp_id'),
            'updated_at'  => Carbon::now(),

        ]);


        $addQty = (int) $request->quantity;
        $stock = DB::table('givings')
            ->where('category_id', $request->category_id)
            ->sum('quantity');

        if ($addQty > $stock) {
            return response()->json([
                'status' => 0,
                'msg'    => 'الكمية المطلوبة أكبر من المتاح بالمخزن.'
            ]);
        } elseif ($request->quantity != null) {

            DB::table('campaigns')
                ->where('id', $campaign->id)
                ->update([
                    'quantity' => DB::raw('quantity + ' . $addQty),
                ]);

            DB::table('givings')
                ->where('category_id', $request->category_id)
                ->decrement('quantity', $addQty);

            return response()->json([
                'status' => 1,
                'msg'    => 'تم تحديث الحملة وإضافة الكمية بنجاح.'
            ]);
        }

        return response()->json([
            'status' => 1,
            'msg'    => 'تم تحديث الحملة بنجاح (بدون خصم من المخزون).'
        ]);
    }


    public function delete($id)
    {

        $campaign = DB::table('campaigns')->where('id', $id)->first();
        if ($campaign->quantity > 0) {
            return response()->json(['status' => 0, 'msg' => 'لا يمكن حذف الحملة لطفآ التاكد من االمخزون !!']);
        } else {
            DB::table('campaigns')->where('id', $id)->update(['isDelete' => 1]);
            return response()->json(['status' => 1, 'msg' => 'تم حذف الحملة بنجاح']);
        }
    }


    public function category_quantity($id)
    {
        $total = DB::table('givings')
            ->where('category_id', $id)
            ->sum('quantity');

        return response()->json([
            'status' => $total > 0,
            'total'  => (int) $total,
        ]);
    }
}
