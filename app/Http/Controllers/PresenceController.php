<?php

namespace App\Http\Controllers;

use App\Models\Presences;
use Illuminate\Http\Request;
use Str;

class PresenceController extends Controller
{
    public function getPresences() {
        $presences = Presences::with('subjects', 'students')->all();

        return response()->json([
            'presences' => $presences
        ], 200);
    }

    public function getPresence($uuid_presence) {
        $presence = Presences::where('uuid_presence', $uuid_presence)->with('subjects', 'students')->first();
        if(!$presence) {
            return response()->json([
                'message' => 'Absen dengan id ' . $uuid_presence . ' tidak ditemukan'
            ], 404);
        } else {
            return response()->json([
                'presence' => $presence
            ], 200);
        }
    }

    public function setPresence(Request $request) {
        if(!$request->subject) {
            return response()->json([
                'message' => 'Mata Pelajaran tidak boleh kosong'
            ], 403);
        }

        if(!$request->student) {
            return response()->json([
                'message' => 'Siswa tidak boleh kosong'
            ], 403);
        }

        $uuid = Str::uuid();

        $presence = Presences::where('uuid_presence', $uuid)->first();
        if($presence) {
            return response()->json([
                'message' => 'Pendafataran gagal, coba lagi!'
            ], 409);
        }

        $newPresence = Presences::create([
            'uuid_presence' => $uuid,
            'subject' => $request->subject,
            'student' => $request->student,
        ]);

        if($newPresence) {
            return response()->json([
                'message' => 'Absen berhasil dibuat'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf! nampaknya terdapat kesalahan'
            ], 500);
        }
    }

    public function putPresence(Request $request, $uuid_presence) {
        if(!$request->subject) {
            return response()->json([
                'message' => 'Mata Pelajaran tidak boleh kosong'
            ], 403);
        }

        if(!$request->student) {
            return response()->json([
                'message' => 'Siswa tidak boleh kosong'
            ], 403);
        }

        $presence= Presences::where('uuid_presence', $uuid_presence)->with('subjects', 'students')->first();
        if(!$presence) {
            return response()->json([
                'message' => 'Absen dengan id ' . $uuid_presence . ' tidak ditemukan'
            ]);
        }

        $presence->update([
            'subject' => $request->subject,
            'student' => $request->student,
        ]);

        return response()->json([
            'message' => 'Absen berhasil di update'
        ], 200);
    }

    public function deletePresence($uuid_presence) {
        $presence = Presences::where('uuid_presence', $uuid_presence)->first();
        if(!$presence) {
            return response()->json([
                'message' => 'Absen dengan id ' . $uuid_presence . ' tidak ditemukan'
            ], 404);
        }

        if($presence->delete()) {
            return response()->json([
                'message' => 'Absen berhasil dihapus'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Maaf! nampaknya terdapat kesalahan'
            ], 500);
        }
    }
}
