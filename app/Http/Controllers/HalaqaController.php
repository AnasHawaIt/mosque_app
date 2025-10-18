<?php

namespace App\Http\Controllers;

use App\Models\Halaqa;
use Illuminate\Http\Request;

class HalaqaController extends Controller
{
    public function index()
    {
        return response()->json(Halaqa::with('quran_instructors_id', 'students')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'halaqa_name' => 'required|string|max:255',
            'halaqa_time' => 'nullable|string',
            'quran_instructors_id' => 'nullable|exists:quran_instructors,id',
        ]);

        $halaqa = Halaqa::create($validated);

        return response()->json(['message' => 'تم إنشاء الحلقة بنجاح', 'halaqa' => $halaqa]);
    }

    public function update(Request $request, $id)
    {
        $halaqa = Halaqa::findOrFail($id);

        $validated = $request->validate([
            'halaqa_name' => 'required|string|max:255',
            'halaqa_time' => 'nullable|string',
            'quran_instructors_id' => 'nullable|exists:teachers,id',
        ]);

        $halaqa->update($validated);

        return response()->json(['message' => 'تم تعديل الحلقة بنجاح', 'halaqa' => $halaqa]);
    }

    public function destroy($id)
    {
        $halaqa = Halaqa::findOrFail($id);
        $halaqa->delete();

        return response()->json(['message' => 'تم حذف الحلقة بنجاح']);
    }
}
