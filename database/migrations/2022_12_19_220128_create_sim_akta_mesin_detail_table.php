<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimAktaMesinDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sim_akta_mesin_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_motor', 255);
            $table->integer('jml_motor');
            $table->integer('daya_motor');
            $table->integer('ttl_daya_motor');
            $table->string('keterangan', 500);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('sim_akta_mesin_detail');
    }
}
