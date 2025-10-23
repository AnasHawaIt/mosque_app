<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStudentStore as RequestsRequestStudentStore;
use App\Http\Requests\RequestStudentUpdate;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::all());
    }

    public function store(RequestsRequestStudentStore $request)
    {
        $student = Student::create($request->validate());

        return response()->json($student, 201);
    }

    public function show($id)
    {
        $student = Student::find($id);

        return $student ? response()->json($student) : response()->json(['message' => 'Not found'], 404);
    }

    public function update(RequestStudentUpdate $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $student->update($request->validate());

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
