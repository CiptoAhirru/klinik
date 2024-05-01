<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListPendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');
        $user = User::find($id);

        return view('home', compact('user'));
    }

    public function history(Request $request)
    {
        $history = DB::table('vw_historypendaftaran')->where('approve', 'belum approve')->get();
        echo json_encode($history);
    }

    public function save(Request $request)
    {
        // Memulai transaksi
        DB::beginTransaction();

        try {
            // Lakukan operasi update dalam transaksi
            Pendaftaran::where('id', $request->id)->update([
                'approve' => $request->status,
                'tglapprove' => date('Y-m-d H:i:s'),
            ]);

            // Commit transaksi jika tidak ada kesalahan
            DB::commit();

            // Berikan respons JSON bahwa pembaruan berhasil
            return response()->json([
                'status' => true,
                'message' => "Data berhasil diperbarui"
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Berikan respons JSON bahwa terjadi kesalahan
            return response()->json([
                'status' => false,
                'message' => "Gagal memperbarui data: " . $e->getMessage()
            ], 500); // Kode status 500 menandakan kesalahan server
        }
    }
}
