<?php

namespace App\Http\Controllers;

use App\Models\StudentsModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationData;

class HomeController extends Controller
{
    public function adminLogin()
    {
        $students = StudentsModel::all();
        return view('admin.dashboard', ['students' => $students]);
    }

    public function userLogin()
    {
        session(['welcome message' => 'Hi']);

        $students = StudentsModel::all();
        return view('user.user-dashboard', ['students' => $students]);
    }

    public function destroyStudents(StudentsModel $students)
    {
        $students->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function storeStudents(Request $request)
    {
        try {
            // dd($request->all());
            $data = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'age' => 'required|integer|max:100',
                'gender' => 'required|string|max:100',
                'grade_level' => 'required|string|max:100',
            ]);

            $students = StudentsModel::create($data);
            return response()->json([
                'id' => $students->id,
                'first_name' => $students->first_name,
                'last_name' => $students->last_name,
                'address' => $students->address,
                'age' => $students->age,
                'gender' => $students->gender,
                'grade_level' => $students->grade_level,
                'message' => 'Student has been uploaded',
                'success' => true
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation error occured',
                'errors' => $e->errors(),
                'success' => false,
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occured: ' . $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }

    public function fetchStudents(StudentsModel $students)
    {
        return response()->json([
            'id' => $students->id,
            'first_name' => $students->first_name,
            'last_name' => $students->last_name,
            'address' => $students->address,
            'age' => $students->age,
            'gender' => $students->gender,
            'grade_level' => $students->grade_level,
            'success' => true
        ]);
    }

    public function updateStudents(Request $request, $id)
    {
        try {

            $data = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'age' => 'required|integer|max:100',
                'gender' => 'required|string|max:100',
                'grade_level' => 'required|string|max:100',
            ]);


            $student = StudentsModel::findOrFail($id);

            $student->update($data);

            return response()->json([
                'id' => $student->id,
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'address' => $student->address,
                'age' => $student->age,
                'gender' => $student->gender,
                'grade_level' => $student->grade_level,
                'success' => true
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation error occured',
                'errors' => $e->errors(),
                'success' => false,
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occured: ' . $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }
}
