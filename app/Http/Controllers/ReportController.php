<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Halaqa;
use App\Models\Student;
use Carbon\Carbon;

class ReportController extends Controller
{
    // 📊 تقرير الحلقات
    public function halaqatReport()
    {
        $halaqat = Halaqa::withCount('students')->get();

        $data = $halaqat->map(function ($halaqa) {
            $totalStudents = $halaqa->students_count;

            $attendedToday = Attendance::whereHas('student', function ($q) use ($halaqa) {
                $q->where('halaqa_id', $halaqa->id);
            })->whereDate('date', Carbon::today())
              ->where('status', 'present')
              ->count();

            $attendanceRate = $totalStudents > 0
                ? round(($attendedToday / $totalStudents) * 100, 2)
                : 0;

            return [
                'halaqa_name' => $halaqa->halaqa_name,
                'total_students' => $totalStudents,
                'attendance_today' => $attendedToday,
                'attendance_rate' => $attendanceRate.'%',
            ];
        });

        return response()->json($data);
    }

    // 🚨 الطلاب الأكثر غيابًا
    public function absentStudents()
    {
        $absentCounts = Attendance::where('status', 'absent')
            ->selectRaw('student_id, COUNT(*) as total_absences')
            ->groupBy('student_id')
            ->orderByDesc('total_absences')
            ->take(10)
            ->get();

        $data = $absentCounts->map(function ($record) {
            $student = Student::find($record->student_id);

            return [
                'student_name' => $student->name ?? 'غير معروف',
                'halaqa_name' => $student->halaqa->halaqa_name ?? 'غير محددة',
                'total_absences' => $record->total_absences,
            ];
        });

        return response()->json($data);
    }
}
