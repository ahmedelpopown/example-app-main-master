<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkLeaveRequest;
use App\Models\Leave;
use App\Models\Regiment;
use App\Models\Soldier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegimentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regiments = Regiment::all(); // بيجيب كل البيانات من جدول regiments
        return view('regiment.index', compact('regiments'));


    }
   

  



    // دالة show لعرض بيانات سرية واحدة مع الجنود غير الموجودين في إجازة



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function updateLeave(Request $request, $leaveId)
    {

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $regiment = Regiment::with('soldiers')->findOrFail($id);
        // هنا نجيب الجنود من السرية التي ليست في حالة leave
        $soldiers = Soldier::where('regiment_id', $id)
            ->where(function ($query) {
                $query->where('status', '!=', 'leave')
                    ->orWhereNull('status');
            })
            ->get();

        return view('single-regiment.index', compact('regiment', 'soldiers'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function updateStatus(Request $request, Soldier $soldier)
    {
        $request->validate([
            'status' => 'required|in:working,leave',
        ]);
    
        $soldier->update([
            'status' => $request->status,
        ]);
    
        return redirect()
            ->back()
            ->with('success', 'تم تحديث حالة الجندي بنجاح');
    }
}
