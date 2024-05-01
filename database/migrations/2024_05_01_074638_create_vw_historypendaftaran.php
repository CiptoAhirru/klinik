<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW vw_historypendaftaran as
            SELECT
                p.id, p.approve as idapprove, u.nama, concat(d.nama, ' - ', t.nama) as dokter, p.keluhan, p.tanggal, p.user_id, case when p.approve = 0 then 'belum approve' else 'approve' end as approve
            FROM pendaftarans p
            LEFT JOIN treatmens t ON p.id_treatment = t.id
            left join users u ON u.id = p.user_id AND u.role = 2
            LEFT JOIN dokters d ON d.id= p.id_dokter
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vw_historypendaftaran');
    }
};
