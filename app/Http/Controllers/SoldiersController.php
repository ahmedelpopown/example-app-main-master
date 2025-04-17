<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestSoldier;
use App\Http\Requests\UpdateSoldierRequest;
use App\Models\Authority;
use App\Models\Batch;
use App\Models\Job;
 use App\Models\Leave;
use App\Models\Regiment;
use App\Models\Soldier;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
 use Intervention\Image\ImageManager;
 use Illuminate\Support\Facades\Storage;





class SoldiersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // إعداد الاستعلام الأساسي لعرض جميع الجنود بشكل افتراضي
        $query = Soldier::with('regiment');

        // التحقق من الـ checkbox الذي يطلب عرض الجنود في إجازة فقط
        if ($request->has('status') && $request->status == 'leave') {
            $query->where('status', 'leave'); // تصفية الجنود في إجازة
        }

        // جلب الجنود بناءً على الفلاتر
        $soldiers = $query->get();

        // جلب الأقسام (الفرق)
        $regiments = Regiment::select('id', 'name')->get();

        // إرجاع العرض مع الجنود والفرق
        return view('soldiers-data.index', compact('soldiers', 'regiments'));
    }

    public function updateStatus(Request $request, $id)
    {
        $soldier = Soldier::find($id);
    
        if (!$soldier) {
            return response()->json(['success' => false, 'message' => 'الجندي غير موجود']);
        }
    
        // تحديث الحالة
        $soldier->status = $request->status;
        $soldier->save();
    
        return response()->json(['success' => true, 'message' => 'تم تحديث الحالة']);
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regiments = Regiment::all();
        $batches = Batch::all();
        $authorities = Authority::all();
        $jobs = Job::all(); // ✅ الصح
      

                return view('soldiers.create', compact('regiments', 'batches', 'authorities','jobs'));
    }

    

    /**
     * Store a newly created resource in storage.
     */



     public function store(RequestSoldier $request)
     {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
    
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image)->resize(300, 300);
    
            $path = 'soldiers/' . $filename;
            Storage::disk('public')->put($path, (string) $img->encode());
    
            $data['image'] = $path;
        }
    
        Soldier::create($data); // ✅ الصح
    
        return redirect()->route('soldiers.index')->with('success', 'تم إضافة الجندي بنجاح');
     }
     






    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $soldier = Soldier::findOrFail($id);  // جلب الجندي باستخدام الـ ID
        $regiments = Regiment::all();         // جلب جميع السرايا
        $batches = Batch::all();              // جلب جميع الدفعات
        $authorities = Authority::all();      // جلب جميع الجهات
        
        $jobs = Job::all(); // ✅ الصح

        return view('soldiers.edit', compact('soldier', 'regiments','batches' ,'authorities','jobs'));

    }
// Meredith Burch =>William Ortiz
    /**
     * Mitchell Beahan->Phoebe Mcmillan
     * Update the specified resource in storage.
     *
     */
    public function update(RequestSoldier $request, $id)
    {
        $soldier = Soldier::findOrFail($id);
    
        // تحقق من البيانات المُدخلة بعد التحقق (validation)
        $data = $request->validated();
    
        // لو فيه صورة جديدة، احذف القديمة واحتفظ بالجديدة
        if ($request->hasFile('image')) {
            if ($soldier->image && Storage::disk('public')->exists($soldier->image)) {
                Storage::disk('public')->delete($soldier->image);
            }
    
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
    
            $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $img = $manager->read($image)->resize(300, 300);
            $path = 'soldiers/' . $filename;
            Storage::disk('public')->put($path, (string) $img->encode());
    
            $data['image'] = $path;
        }
    
        // تحديث كافة الحقول
        $soldier->update($data);
    
        // لو فيه حالة مضافة من الفورم (status)، حدّثها
        if ($request->has('status')) {
            $soldier->status = $request->input('status');
            $soldier->save();
        }
    
        // استجابة حسب نوع الطلب
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم تحديث بيانات المجند بنجاح',
                'soldier' => $soldier
            ]);
        }
    
        return redirect()->route('soldiers.index')->with('success', 'تم تحديث بيانات المجند بنجاح');
    }
    
    
    
    // William Ortiz	=>
    




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $soldier = Soldier::findOrFail($id);
        $soldier->delete();

        return redirect()->route('soldiers.index')->with('success', 'تم حذف الجندي بنجاح');
    }

 

}
