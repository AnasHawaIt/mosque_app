<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestHalaqaStore;
use App\Http\Requests\RequestHalaqaUpdate;
use App\Models\Halaqa;

class HalaqaController extends Controller
{
    public function index()
    {
        return response()->json(Halaqa::with('quran_instructors_id', 'students')->get());
    }

    public function store(RequestHalaqaStore $request)
    {
        $halaqa = Halaqa::create($request->validate());

        return response()->json(['message' => 'تم إنشاء الحلقة بنجاح', 'halaqa' => $halaqa]);
    }

    public function update(RequestHalaqaUpdate $request, $id)
    {
        $halaqa = Halaqa::findOrFail($id);
        $halaqa->update($request->validate());
        return response()->json(['message' => 'تم تعديل الحلقة بنجاح', 'halaqa' => $halaqa]);
    }

    public function destroy($id)
    {
        $halaqa = Halaqa::findOrFail($id);
        $halaqa->delete();

        return response()->json(['message' => 'تم حذف الحلقة بنجاح']);
    }
}
