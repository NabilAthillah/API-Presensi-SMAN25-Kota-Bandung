<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function getClasses() {
        $classes = Classes::with('teacher')->get();

        return response()->json([
            'classes' => $classes
        ], 200);
    }

    public function getClass($name) {
        $class = Classes::where('name', $name)->with('teacher')->first();
        if(!$class) {
            return response()->json([
                'message' => 'Kelas ' . $name . ' tidak ditemukan'
            ], 404);
        } else {
            return response()->json([
                'class' => $class
            ], 200);
        }
    }

    public function setClass(Request $request) {
        if(!$request->name) {
            return response()->json([
                'message' => 'Nama tidak boleh kosong'
            ], 403);
        }

        if(!$request->classroom_teacher) {
            return response()->json([
                'message' => 'Wali Kelas tidak boleh kosong'
            ], 403);
        }

        $class = Classes::where('name', $request->name)->first();
        if($class) {
            return response()->json([
                'message' => 'Kelas sudah terdaftar'
            ], 409);
        }

        $newClass = Classes::create([
            'name' => $request->name,
            'classroom_teacher' => $request->classroom_teacher
        ]);

        if($newClass) {
            return response()->json([
                'message' => 'Kelas berhasil dibuat'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf! nampaknya terdapat kesalahan'
            ], 500);
        }
    }

    public function putClass(Request $request, $name) {
        if(!$request->name) {
            return response()->json([
                'message' => 'Nama tidak boleh kosong'
            ], 403);
        }

        if(!$request->classrom_teacher) {
            return response()->json([
                'message' => 'Wali Kelas tidak boleh kosong'
            ], 403);
        }

        $class= Classes::where('name', $name)->with('teacher')->first();
        if(!$class) {
            return response()->json([
                'message' => 'Kelas ' . $name . ' tidak ditemukan'
            ]);
        }

        $class->update([
            'name' => $request->name,
            'classroom_teacher' => $request->classroom_teacher
        ]);

        return response()->json([
            'message' => 'Kelas berhasil di update'
        ], 200);
    }

    public function deleteClass($name) {
        $class = Classes::where('name', $name)->first();
        if(!$class) {
            return response()->json([
                'message' => 'Kelas ' . $name . ' tidak ditemukan'
            ], 404);
        }

        if($class->delete()) {
            return response()->json([
                'message' => 'Kelas berhasil dihapus'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf! nampaknya terdapat kesalahan'
            ], 500);
        }
    }
}
