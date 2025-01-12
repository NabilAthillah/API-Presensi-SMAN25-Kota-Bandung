<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getStudents() {
        $students = Students::with('parents', 'class')->all();

        return response()->json([
            'students' => $students
        ], 200);
    }

    public function getStudent($nisn) {
        $student = Students::where('nisn', $nisn)->with('parents', 'class')->first();

        if($student) {
            return response()->json([
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'message' => 'Siswa dengan nisn ' . $nisn . ' tidak ditemukan'
            ], 404);
        }
    }

    public function setStrudent(Request $request) {
        if(!$request->nisn) {
            return response()->json([
                'message' => 'NISN tidak boleh kosong',
            ], 403);
        }

        if(!$request->name) {
            return response()->json([
                'message' => 'Nama tidak boleh kosong',
            ], 403);
        }

        if(!$request->email) {
            return response()->json([
                'message' => 'email tidak boleh kosong',
            ], 403);
        }

        if(!$request->address) {
            return response()->json([
                'message' => 'Address tidak boleh kosong',
            ], 403);
        }

        if(!$request->phone_number) {
            return response()->json([
                'message' => 'Nomor Handphone tidak boleh kosong',
            ], 403);
        }

        if(!$request->parents) {
            return response()->json([
                'message' => 'Orang Tua tidak boleh kosong',
            ], 403);
        }

        if(!$request->class) {
            return response()->json([
                'message' => 'Kelas tidak boleh kosong',
            ], 403);
        }

        $student = Students::where('nisn', $request->nisn)->first();
        if($student) {
            return response()->json([
                'message' => 'NISN sudah terdaftar'
            ], 409);
        }

        $newStudent = Students::create([
            'nisn' => $request->nisn,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->nisn),
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'parents' => $request->parents,
            'class' => $request->class
        ]);

        if($newStudent) {
            return response()->json([
                'message' => 'Siswa berhasil dibuat'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf! nampaknya terdapat kesalahan'
            ], 500);
        }
    }
}
