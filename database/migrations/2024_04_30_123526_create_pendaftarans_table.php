<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('tanggal');
            $table->string('user_id');
            $table->string('keluhan');
            $table->boolean('approve');
            $table->timestamp('tglapprove');
            $table->string('id_dokter');
            $table->string('id_treatment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftarans');
    }
};
