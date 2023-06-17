<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi');
            $table->string('nilai_transfer');
            $table->string('kode_unik');
            $table->string('biaya_admin');
            $table->string('total_transfer');
            $table->string('bank_tujuan');
            $table->string('bank_pengirim');
            $table->string('atasnama_tujuan');
            $table->string('bank_perantara');
            $table->string('rekening_perantara');
            $table->string('berlaku_hingga');
            $table->string('rekening_tujuan');
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
        Schema::dropIfExists('transfers');
    }
}
