<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Teachers;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        if(!$request->email) {
            return response()->json([
                'message' => 'Email tidak boleh kosong',
            ], 403);
        }

        if(!$request->password) {
            return response()->json([
                'message' => 'Password tidak boleh kosong',
            ], 403);
        }

        $student = Students::where('email', $request->email)->first();
        if($student){
            if(Hash::check('password', $request->password)) {
                return response()->json([
                    'message' => 'Login berhasil',
                    'role' => 'student',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Password salah',
                ], 401);
            }
        }

        $teacher = Teachers::where('email', $request->email)->first();
        if($teacher){
            if(Hash::check($request->password, $teacher->password)) {
                return response()->json([
                    'message' => 'Login berhasil',
                    'role' => $teacher->role
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Password salah',
                ], 401);
            }
        }
        
        return response()->json([
            'message' => 'User tidak ditemukan'
        ], 404);
    }
}
