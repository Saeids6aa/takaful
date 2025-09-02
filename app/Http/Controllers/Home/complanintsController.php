<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class complanintsController extends Controller
{
    public function index()
    {
        return view('Home.home', ['openComplaint' => true]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'person_name' => 'required|string|min:2|max:255',
            'phone'       => 'required|string|max:20',
            'title'       => 'required|string|min:3|max:255',
            'description' => 'required|string|min:5|max:5000',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'person_name.required' => 'الاسم مطلوب',
            'phone.required'       => 'رقم الهاتف مطلوب',
            'title.required'       => 'عنوان الشكوى مطلوب',
            'description.required' => 'نص الشكوى مطلوب',
            'image.image'          => 'الملف يجب أن يكون صورة',
            'image.mimes'          => 'الصيغ المسموحة: jpeg, png, jpg, gif, webp',
            'image.max'            => 'حجم الصورة الأقصى 2MB',
        ]);
    
        $data = $request->only(['person_name','phone','title','description']);

        // رفع الصورة (اختياري)
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time().'_'.Str::random(8).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/complaints'), $filename);
            $data['image'] = $filename;
        }

        Complaint::create($data);

        return response()->json([
            'status' => 1,
            'msg'    => 'تم إرسال الشكوى بنجاح، سنقوم بمراجعتها قريباً.',
            'close'  => true,      
        ]);
    }
}