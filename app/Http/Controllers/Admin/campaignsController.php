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
use Illuminate\Validation\Rule;
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
        $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'description' => 'required|string|max:265|min:6',
            'category_id' => 'required|exists:categories,id',
            'camp_id'     => 'required|exists:camps,id',
            'quantity'    => 'required|numeric|min:1',
            'giving_id'   => ['required', Rule::exists('givings', 'id')->where(
                fn($q) => $q->where('category_id', $request->category_id)->where('isDelete', 0)
            )],
        ], [
            'title.required' => 'العنوان مطلوب',
            'description.required' => 'الوصف مطلوب',
            'category_id.required' => 'الفئة مطلوبة',
            'camp_id.required' => 'المخيم مطلوب',
            'quantity.required' => 'الكمية مطلوبة',
        ]);

        $admin_id   = 1;
        $created_at = Carbon::now();

        // ✅ 1. التأكد من العطاء وكميته
        $giving = DB::table('givings')
            ->where('id', $request->giving_id)
            ->where('category_id', $request->category_id)
            ->where('isDelete', 0)
            ->first();

        if (!$giving) {
            return response()->json(['status' => 0, 'msg' => 'العطاء غير صالح أو لا يتبع الفئة المحددة.']);
        }

        if ($giving->quantity < $request->quantity) {
            return response()->json(['status' => 0, 'msg' => 'الكمية المطلوبة أكبر من المتاح من هذا العطاء.']);
        }

        // ✅ 2. إنشاء الحملة
        $campaign_id = DB::table('campaigns')->insertGetId([
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'camp_id'     => $request->camp_id,
            'quantity'    => $request->quantity,
            'admin_id'    => $admin_id,
            'status'      => 'Inprogress',
            'created_at'  => $created_at,
            'updated_at'  => $created_at,
        ]);

        // ✅ 3. تسجيل الكمية المستخدمة من هذا العطاء في جدول الوصلة
        DB::table('campaign_giving')->insert([
            'campaign_id' => $campaign_id,
            'giving_id'   => $request->giving_id,
            'quantity'    => $request->quantity,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // ✅ 4. خصم الكمية من العطاء
        DB::table('givings')->where('id', $request->giving_id)->decrement('quantity', $request->quantity);

        // ✅ 5. إذا صارت الكمية صفر، يتم وضع isDelete = 1
        $remainingQty = DB::table('givings')->where('id', $request->giving_id)->value('quantity');
        DB::table('givings')->where('id', $request->giving_id)->update([
            'isDelete'   => ($remainingQty <= 0 ? 1 : 0),
            'updated_at' => now(),
        ]);

        return response()->json(['status' => 1, 'msg' => 'تم إضافة الحملة بنجاح.']);
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
            'giving_id'   => ['nullable', Rule::exists('givings', 'id')->where(
                fn($q) => $q->where('category_id', $request->category_id)->where('isDelete', 0)
            )],
            'quantity'    => 'nullable|integer|min:1',
      
        ], [
            'title.required'       => 'العنوان مطلوب',
            'category_id.required' => 'الفئة مطلوبة',
            'camp_id.required'     => 'المخيم مطلوب',
        ]);

        $campaign = Campaign::findOrFail($id);

        $campaign->update([
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'camp_id'     => $request->camp_id,
            'updated_at'  => now(),
        ]);

        $addQty = (int) $request->quantity;

        if ($addQty && $request->giving_id) {
            $giving = DB::table('givings')->where('id', $request->giving_id)->first();

            if (!$giving || $giving->quantity < $addQty) {
                return response()->json([
                    'status' => 0,
                    'msg'    => 'الكمية المطلوبة أكبر من المتاحة لدى هذا المانح.'
                ]);
            }

            DB::table('givings')
                ->where('id', $request->giving_id)
                ->decrement('quantity', $addQty);

            DB::table('givings')
                ->where('id', $request->giving_id)
                ->update([
                    'isDelete'   => ($giving->quantity - $addQty) == 0 ? 1 : 0,
                    'updated_at' => now(),
                ]);

            $campaign->increment('quantity', $addQty);

            DB::table('campaign_giving')->insert([
                'campaign_id' => $campaign->id,
                'giving_id'   => $request->giving_id,
                'quantity'    => $addQty,
                'created_at'  => now(),
            ]);

            return response()->json([
                'status' => 1,
                'msg'    => 'تم تحديث الحملة وإضافة الكمية وربطها بالمانح بنجاح.'
            ]);
        }

        return response()->json([
            'status' => 1,
            'msg'    => 'تم تحديث بيانات الحملة بنجاح.'
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

    public function byCategory($category_id)
    {
        return DB::table('givings')
            ->join('doners', 'doners.id', '=', 'givings.doner_id')
            ->where('givings.category_id', $category_id)
            ->where('givings.isDelete', 0)
            ->where('givings.quantity', '>', 0)
            ->select('givings.id', 'doners.name as donor', 'givings.quantity')
            ->orderBy('givings.quantity', 'desc')
            ->get();
    }
}
