<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Treatmen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');
        $user = User::find($id);

        $treatment = Treatmen::all();

        return view('pendaftaran', compact('user', 'treatment'));
    }

    public function dokter(Request $request)
    {
        $dokter = DB::table('vw_doktertreatmen')->where('id_treatment', $request->id_treatment)->get();
        echo json_encode($dokter);
    }

    public function save(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // Buat instance model Pendaftaran
                $pendaftaran = new Pendaftaran();

                // Isi atribut-atribut model dengan data dari request
                $pendaftaran->tanggal = $request->tanggal;
                $pendaftaran->user_id = $request->userid;
                $pendaftaran->keluhan = $request->keluhan;
                $pendaftaran->approve = '0';
                $pendaftaran->id_dokter = $request->id_dokter;
                $pendaftaran->id_treatment = $request->id_treatmen;
                // Simpan model ke dalam database
                $pendaftaran->save();
            });

            // Jika transaksi berhasil, kembalikan respons JSON dengan status berhasil
            return response()->json([
                'status' => true,
                'message' => "Data berhasil disimpan"
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tangkap pengecualian dan kembalikan respons JSON dengan status gagal
            return response()->json([
                'status' => false,
                'message' => "Gagal menyimpan data: " . $e->getMessage()
            ], 500); // Kode status 500 menandakan kesalahan server
        }
    }

    public function history(Request $request)
    {
        $dokter = DB::table('vw_historypendaftaran')->where('user_id', $request->userid)->get();
        echo json_encode($dokter);
    }
}
