<?php

namespace App\Http\Controllers\API;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        if ($teachers->count() > 0) {
            return response()->json([
                'status' => 200,
                'teachers' => $teachers
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Matches Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'age' => 'required|integer',
            'address' => 'required|string|max:250',
            'department' => 'required|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $teacher = Teacher::create([
                'name' => $request->name,
                'age' => $request->age,
                'address' => $request->address,
                'department' => $request->department,
            ]);

            if ($teacher) {
                return response()->json([
                    'status' => 200,
                    'status_message' => "Teacher Data successfully created!"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'error_message' => "Error!: Something Went Wrong"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);

        if ($teacher) {
            return response()->json([
                'status' => 200,
                'teacher' => $teacher
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => "No Teacher Data Found!"
            ], 404);
        }
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);

        if ($teacher) {
            return response()->json([
                'status' => 200,
                'teacher' => $teacher
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => "No Teacher Data Found!"
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'age' => 'required|integer',
            'address' => 'required|string|max:250',
            'department' => 'required|string|max:250',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $teacher = Teacher::find($id);

            if ($teacher) {
                $teacher->update([
                    'name' => $request->name,
                    'age' => $request->age,
                    'address' => $request->address,
                    'department' => $request->department,
                ]);

                return response()->json([
                    'status' => 200,
                    'status_message' => "Teacher Data successfully updated!"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'error_message' => "No Such Teacher Data Found!"
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if ($teacher) {
            if ($teacher->delete()) {
                return response()->json([
                    'status' => 200,
                    'status_message' => "Teacher Data successfully deleted!"
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'error_message' => "Failed to delete teacher data."
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 404,
                'error_message' => "No Such Teacher Data Found!"
            ], 404);
        }
    }
}
