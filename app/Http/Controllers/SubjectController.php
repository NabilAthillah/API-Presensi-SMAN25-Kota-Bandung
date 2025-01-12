<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use Illuminate\Http\Request;
use Str;

class SubjectController extends Controller
{
    public function getSubjects() {
        $subjects = Subjects::with('teacher_employees', 'class')->all();

        return response()->json([
            'subjects' => $subjects
        ], 200);
    }

    public function getSubject($uuid_subject) {
        $subject = Subjects::where('uuid_subject', $uuid_subject)->with('teacher_employees', 'class')->first();
        if(!$subject) {
            return response()->json([
                'message' => 'Mata Pelajaran dengan id ' . $uuid_subject . ' tidak ditemukan'
            ], 404);
        } else {
            return response()->json([
                'subject' => $subject
            ], 200);
        }
    }

    public function setSubject(Request $request) {
        if(!$request->name) {
            return response()->json([
                'message' => 'Nama tidak boleh kosong'
            ], 403);
        }

        if(!$request->day) {
            return response()->json([
                'message' => 'Hari tidak boleh kosong'
            ], 403);
        }

        if(!$request->time) {
            return response()->json([
                'message' => 'Waktu tidak boleh kosong'
            ], 403);
        }

        if(!$request->duration) {
            return response()->json([
                'message' => 'Durasi tidak boleh kosong'
            ], 403);
        }

        if(!$request->teacher) {
            return response()->json([
                'message' => 'Guru tidak boleh kosong'
            ], 403);
        }

        if(!$request->class) {
            return response()->json([
                'message' => 'Kelas tidak boleh kosong'
            ], 403);
        }

        $uuid = Str::uuid();

        $subject = Subjects::where('uuid_subject', $uuid)->first();
        if($subject) {
            return response()->json([
                'message' => 'Pendafataran gagal, coba lagi!'
            ], 500);
        }

        $newSubject = Subjects::create([
            'uuid_subject' => $uuid,
            'name' => $request->name,
            'day' => $request->day,
            'time' => $request->time,
            'duration' => $request->duration,
            'teacher' => $request->teacher,
            'class' => $request->class
        ]);

        if($newSubject) {
            return response()->json([
                'message' => 'Mata Pelajaran berhasil dibuat'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf! nampaknya terdapat kesalahan'
            ], 500);
        }
    }

    public function putSubject(Request $request, $uuid_subject) {
        if(!$request->name) {
            return response()->json([
                'message' => 'Nama tidak boleh kosong'
            ], 403);
        }

        if(!$request->day) {
            return response()->json([
                'message' => 'Hari tidak boleh kosong'
            ], 403);
        }

        if(!$request->time) {
            return response()->json([
                'message' => 'Waktu tidak boleh kosong'
            ], 403);
        }

        if(!$request->duration) {
            return response()->json([
                'message' => 'Durasi tidak boleh kosong'
            ], 403);
        }

        if(!$request->teacher) {
            return response()->json([
                'message' => 'Guru tidak boleh kosong'
            ], 403);
        }

        if(!$request->class) {
            return response()->json([
                'message' => 'Kelas tidak boleh kosong'
            ], 403);
        }

        $subject= Subjects::where('uuid_subject', $uuid_subject)->with('teacher_employees', 'class')->first();
        if(!$subject) {
            return response()->json([
                'message' => 'Mata Pelajaran dengan id ' . $uuid_subject . ' tidak ditemukan'
            ]);
        }

        $subject->update([
            'name' => $request->name,
            'day' => $request->day,
            'time' => $request->time,
            'duration' => $request->duration,
            'teacher' => $request->teacher,
            'class' => $request->class
        ]);

        return response()->json([
            'message' => 'Mata Pelajarann berhasil di update'
        ], 200);
    }

    public function deleteSubject($uuid_subject) {
        $subject = Subjects::where('uuid_subject', $uuid_subject)->first();
        if(!$subject) {
            return response()->json([
                'message' => 'Mata Pelajaran dengan id ' . $uuid_subject . ' tidak ditemukan'
            ], 404);
        }

        if($subject->delete()) {
            return response()->json([
                'message' => 'Mata Pelajaran berhasil dihapus'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf! nampaknya terdapat kesalahan'
            ], 500);
        }
    }
}
