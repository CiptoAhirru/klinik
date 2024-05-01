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
            CREATE VIEW vw_doktertreatmen as
            SELECT
                dt.id_treatment, t.nama as treatment, dt.id_dokter, d.nama as dokter
            FROM dokter_treatmens dt
            LEFT JOIN dokters d ON d.id = dt.id_dokter
            LEFT JOIN treatmens t ON t.id = dt.id_treatment
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vw_doktertreatmen');
    }
};
