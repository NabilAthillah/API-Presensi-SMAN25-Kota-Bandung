<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use DateTime;
use Hash;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function getParents() {
        $parents = Parents::all();

        return response()->json([
            'parents' => $parents
        ], 200);
    }

    public function getParent($email) {
        $parent = Parents::where('email', $email)->first();
        if(!$parent) {
            return response()->json([
                'message' => 'Orang tua dengan email ' . $email . ' tidak ditemukan'
            ], 404);
        } else {
            return response()->json([
                'parent' => $parent
            ], 200);
        }
    }

    public function setParent(Request $request) {
        if(!$request->email) {
            return response()->json([
                'message' => 'Email tidak boleh kosong'
            ], 403);
        }
        if(!$request->name) {
            return response()->json([
                'message' => 'Nama tidak boleh kosong'
            ], 403);
        }
        if(!$request->phone_number) {
            return response()->json([
                'message' => 'Nomor Handphone tidak boleh kosong'
            ], 403);
        }

        $parent = Parents::where('email', $request->email)->first();
        if($parent) {
            return response()->json([
                'message' => 'Email sudah terdaftar'
            ], 409);
        }

        $newParent = Parents::create([
            'email' => $request->email,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'password' => Hash::make('orangtuasiswasman25kotabandung'),
            'verified_status' => 'verified',
            'verified_at' => new DateTime()
        ]);

        if($newParent) {
            return response()->json([
                'message' => 'Orang Tua berhasil dibuat'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf! nampaknya terdapat kesalahan'
            ], 500);
        }
    }

    public function putParent(Request $request, $email) {
        if(!$request->email) {
            return response()->json([
                'message' => 'Email tidak boleh kosong'
            ], 403);
        }
        if(!$request->name) {
            return response()->json([
                'message' => 'Nama tidak boleh kosong'
            ], 403);
        }
        if(!$request->phone_number) {
            return response()->json([
                'message' => 'Nomor Handphone tidak boleh kosong'
            ], 403);
        }

        $parent= Parents::where('email', $email)->first();
        if(!$parent) {
            return response()->json([
                'message' => 'Orang Tua dengan email ' . $email . ' tidak ditemukan'
            ]);
        }

        if($request->password) {
            if(Hash::check($request->oldPassword, $parent->password)) {
                $parent->update([
                    'email' => $request->email,
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'phone_number' => $request->phone_number,
                ]);
            } else {
                return response()->json([
                    'message' => 'Password lama salah'
                ], 403);
            }
        } else {
            $parent->update([
                'email' => $request->email,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
            ]);
        }

        return response()->json([
            'message' => 'Orang Tua berhasil di update'
        ], 200);
    }

    public function deleteParent($email) {
        $parent = Parents::where('email', $email)->first();
        if(!$parent) {
            return response()->json([
                'message' => 'Orang Tua dengan email ' . $email . ' tidak ditemukan'
            ], 404);
        }

        if($parent->delete()) {
            return response()->json([
                'message' => 'Orang Tua berhasil dihapus'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf! nampaknya terdapat kesalahan'
            ], 500);
        }
    }
}
