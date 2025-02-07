<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\Students;
use App\Models\Teachers;
use Hash;
use Illuminate\Http\Request;
use Str;

class AuthController extends Controller
{
    public function login(Request $request) {
        if(!$request->nisnip) {
            return response()->json([
                'message' => 'NIP / NIS tidak boleh kosong',
            ], 403);
        }

        if(!$request->password) {
            return response()->json([
                'message' => 'Password tidak boleh kosong',
            ], 403);
        }

        $token = Str::random(60);

        $student = Students::where('nisn', $request->nisnip)->first();
        if($student){
            if(Hash::check('password', $request->password)) {
                return response()->json([
                    'message' => 'Login berhasil, selamat datang ' . $student->name . '!',
                    'role' => 'student',
                    'token' => $token
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Password salah',
                ], 401);
            }
        }

        $teacher = Teachers::where('nip', $request->nisnip)->first();
        if($teacher){
            if(Hash::check($request->password, $teacher->password)) {
                return response()->json([
                    'message' => 'Login berhasil, selamat datang ' . $teacher->name . '!',
                    'role' => $teacher->role,
                    'token' => $token
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

    public function loginParent(Request $request) {
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

        $token = Str::random(60);

        $parent = Parents::where('email', $request->email)->first();
        if($parent) {
            if($parent->verified_status == 'verified') {
                if(Hash::check($request->password, $parent->password)) {
                    return response()->json([
                        'message' => 'Login berhasil, selamat datang ' . $parent->name . '!',
                        'role' => 'parent',
                        'token' => $token
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Password salah',
                    ], 401);
                }
            } else {
                return response()->json([
                    'message' => 'Email ini belum diverifikasi',
                ], 401);
            }
        }

        return response()->json([
            'message' => 'User tidak ditemukan'
        ], 404);
    }
}
