<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if ($students->count() > 0) {
            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'Status_message' => 'No Matches Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'age' => 'required|integer',
            'address' => 'required|string|max:250',
            'course' => 'required|string|max:250',
            'subject' => 'required|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $student = Student::create([
                'name' => $request->name,
                'age' => $request->age,
                'address' => $request->address,
                'course' => $request->course,
                'subject' => $request->subject,
            ]);

            if ($student) {
                return response()->json([
                    'status' => 200,
                    'Success_message' => "Student Data successfully created!"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'Error_message' => "Error!: Something Went Wrong"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $student = Student::find($id);

        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'Success_message' => "No Student Data Found!"
            ], 404);
        }
    }

    public function edit($id)
    {
        $student = Student::find($id);

        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'Success_message' => "No Student Data Found!"
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'age' => 'required|integer',
            'address' => 'required|string|max:250',
            'course' => 'required|string|max:250',
            'subject' => 'required|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $student = Student::find($id);

            if ($student) {
                $student->update([
                    'name' => $request->name,
                    'age' => $request->age,
                    'address' => $request->address,
                    'course' => $request->course,
                    'subject' => $request->subject,
                ]);

                return response()->json([
                    'status' => 200,
                    'Success_message' => "Student Data successfully updated!"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'Error_message' => "No Such Student Data Found!"
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            if ($student->delete()) {
                return response()->json([
                    'status' => 200,
                    'Success_message' => "Student Data successfully deleted!"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'Error_message' => "Failed to delete student data."
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 404,
                'Error_message' => "No Such Student Data Found!"
            ], 404);
        }
    }
}
