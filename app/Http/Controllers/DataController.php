<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getUser(Request $request) {
        if(!$request->email) {
            return response()->json([
                'message' => 'Email tidak boleh kosong',
            ], 403);
        }

        $student = Students::select('nisn', 'name', 'email', 'address', 'phone_number')->where('email', $request->email)->first();
        if($student) {
            return response()->json([
                'message' => 'Student Data',
                'data' => $student,
                'role' => 'Student'
            ], 200);
        }

        $teacher = Teachers::select('nip', 'name', 'email', 'address', 'phone_number', 'role')->where('email', $request->email)->first();
        if($teacher) {
            return response()->json([
                'message' => 'Teacher Data',
                'data' => $teacher
            ], 200);
        }

        return response()->json([
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    public function setStudent(Request $request) {


        return response()->json([
            'message' => 'Student'
        ]);
    }
}
