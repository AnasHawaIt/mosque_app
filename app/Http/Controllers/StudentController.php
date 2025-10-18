<?php

namespace App\Http\Controllers;

use App\Models\Student;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function index()
    {
        return response()->json(Student::all());
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'first_name'=>'required|string|min:3|max:255',
            'last_name'=>'required|string|min:3|max:255',
            'phone'=>'required|unique:students,phone|regex:/^09\d{8}$/',

        ]);
        if($validate->failed()){
            return response()->json([
                'error'=>$validate->errors()
            ]);
        }
        $student = Student::create([
            'halaqa_id' => $request->halaqa_id,
            'first_name' => $request->first_name,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone
        ]);

        return response()->json($student, 201);
    }

    public function show($id)
    {
        $student = Student::find($id);
        return $student ? response()->json($student) : response()->json(['message' => 'Not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $student->update($request->all());
        return response()->json($student);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $student->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}

