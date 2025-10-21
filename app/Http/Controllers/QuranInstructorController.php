<?php

namespace App\Http\Controllers;

use App\Models\Quran_instructor;
use Illuminate\Http\Request;

class QuranInstructorController extends Controller
{
    public function index()
    {
        return response()->json(Quran_instructor::all());
    }

    public function store(Request $request)
    {
        $quran_instructor = Quran_instructor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return response()->json($quran_instructor, 201);
    }

    public function show($id)
    {
        $quran_instructor = Quran_instructor::Find($id);

        return $quran_instructor ? response()->json($quran_instructor) : response()->json(['message' => 'Not found'], 404);
    }

    public function edit(Quran_instructor $quran_instructor)
    {
    }

    public function update(Request $request, $id)
    {
        $quran_instructor = Quran_instructor::Find($id);
        if (!$quran_instructor) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $quran_instructor = Quran_instructor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'halaqa_name' => $request->halaqa_name,
            'address' => $request->address,
        ]);

        return response()->jsonp($quran_instructor, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $quran_instructor = Quran_instructor::Find($id);
        if (!$quran_instructor) {
            return response()->json(['massage' => 'NOt Found'], 404);
        }
        $quran_instructor->delete();

        return response()->json(['message' => 'delete succsessfully'], 200);
    }
}
