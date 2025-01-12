<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Hash;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function getTeachers() {
        $teachers = Teachers::all();

        if($teachers) {
            return response()->json([
                'teachers' => $teachers
            ], 200);
        } else {
            return response()->json([
                'teachers' => []
            ], 200);
        }
    }

    public function getTeacher($nip) {
        $teacher = Teachers::where('nip', $nip)->first();

        if($teacher) {
            return response()->json([
                'teacher' => $teacher
            ], 200);
        } else {
            return response()->json([
                'message' => 'Guru / Pegawai dengan nip ' . $nip . ' tidak ditemukan'
            ], 404);
        }
    }

    public function setTeacher(Request $request) {
        if($request->nip) {
            return response()->json([
                'message' => 'NIP tidak boleh kosong',
            ], 403);
        }

        if($request->name) {
            return response()->json([
                'message' => 'Nama tidak boleh kosong',
            ], 403);
        }

        if($request->email) {
            return response()->json([
                'message' => 'Email tidak boleh kosong',
            ], 403);
        }

        if($request->address) {
            return response()->json([
                'message' => 'Alamat tidak boleh kosong',
            ], 403);
        }

        if($request->phone_number) {
            return response()->json([
                'message' => 'Nomor Handphone tidak boleh kosong',
            ], 403);
        }

        $teacher = Teachers::where('nip', $request->nip)->first();
        if($teacher) {
            return response()->json([
                'message' => 'NIP sudah terdaftar'
            ], 409);
        }

        $newTeacher = Teachers::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->nip),
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'role' => 'teacher'
        ]);

        if($newTeacher) {
            return response()->json([
                'message' => 'Guru / Pegawai berhasil dibuat'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf! nampaknya terdapat kesalahan'
            ], 500);
        }
    }

    public function putTeacher(Request $request, $nip) {
        if($request->nip) {
            return response()->json([
                'message' => 'NIP tidak boleh kosong',
            ], 403);
        }

        if($request->name) {
            return response()->json([
                'message' => 'Nama tidak boleh kosong',
            ], 403);
        }

        if($request->email) {
            return response()->json([
                'message' => 'Email tidak boleh kosong',
            ], 403);
        }

        if($request->address) {
            return response()->json([
                'message' => 'Alamat tidak boleh kosong',
            ], 403);
        }

        if($request->phone_number) {
            return response()->json([
                'message' => 'Nomor Handphone tidak boleh kosong',
            ], 403);
        }

        $teacher = Teachers::where('nip', $nip)->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Guru / Pegawai dengan NIP ' . $nip . ' tidak ditemukan'
            ], 404);
        }

        if($request->password && $request->oldPassword) {
            if(Hash::check($request->oldPassword, $teacher->password)) {
                $teacher->update([
                    'nip' => $request->nip,
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                ]);
            } else {
                return response()->json([
                    'message' => 'Password lama salah'
                ], 403);
            }
        } else {
            $teacher->update([
                'nip' => $request->nip,
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
            ]);

            return response()->json([
                'message' => 'Guru / Pegawai berhasil di update'
            ], 200);
        }
    }

    public function deleteTeacher($nip) {
        $teacher = Teachers::where('nip', $nip)->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Guru / Pegawai dengan NIP ' . $nip . ' tidak ditemukan'
            ], 404);
        }

        if($teacher->delete()) {
            return response()->json([
                'message' => 'Guru / Pegawai berhasil dihapus'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf! nampaknya terdapat kesalahan'
            ], 500);
        }
    }
}
