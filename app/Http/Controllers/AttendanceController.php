<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return response()->json(Attendance::with('student')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'status' => 'required|string',
        ]);


        $date = now()->toDateString();

        $attendance = Attendance::create([
            'student_id' => $request->student_id,
            'status' => $request->status,
            'date' => $date,
        ]);

        return response()->json([
            'message' => 'تم تسجيل الحضور بنجاح ✅',
            'data' => $attendance,
        ], 201);
    }


    public function showByDate($date)
    {
        $records = Attendance::with('student')
            ->where('date', $date)
            ->get();

        return response()->json($records);
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json(['message' => 'السجل غير موجود'], 404);
        }

        $attendance->update([
            'status' => $request->status,
        ]);

        return response()->json($attendance);
    }

    public function updateByTime(Request $request, $id, $date)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json(['message' => 'السجل غير موجود'], 404);
        }

        $attendance->update([
            'status' => $request->status,
        ]);

        return response()->json($attendance);
    }

 
    public function destroy($id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json(['message' => 'السجل غير موجود'], 404);
        }

        $attendance->delete();

        return response()->json(['message' => 'تم حذف السجل بنجاح']);
    }
}
