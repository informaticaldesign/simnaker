<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimAktaPengawasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sim_akta_pengawasan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_akta', 32);
            $table->string('name', 255);
            $table->integer('company_id');
            $table->string('address', 500);
            $table->string('nama_pemilik', 255);
            $table->string('add_pemilik', 500);
            $table->string('nama_pengurus', 255);
            $table->string('add_pengurus', 500);
            $table->string('jenis_usaha', 255);
            $table->date('tgl_berdiri');
            $table->string('no_akte', 255);
            $table->integer('jml_cabang');

            $table->integer('wni_l_bul_a');
            $table->integer('wni_l_bul_d');
            $table->integer('wni_p_bul_a');
            $table->integer('wni_p_bul_d');
            $table->integer('wna_l_bul_a');
            $table->integer('wna_l_bul_d');
            $table->integer('wna_p_bul_a');
            $table->integer('wna_p_bul_d');
            $table->integer('jml_bul_l');
            $table->integer('jml_bul_p');

            $table->integer('wni_l_bor_a');
            $table->integer('wni_l_bor_d');
            $table->integer('wni_p_bor_a');
            $table->integer('wni_p_bor_d');
            $table->integer('wna_l_bor_a');
            $table->integer('wna_l_bor_d');
            $table->integer('wna_p_bor_a');
            $table->integer('wna_p_bor_d');
            $table->integer('jml_bor_l');
            $table->integer('jml_bor_p');

            $table->integer('wni_l_hl_a');
            $table->integer('wni_l_hl_d');
            $table->integer('wni_p_hl_a');
            $table->integer('wni_p_hl_d');
            $table->integer('wna_l_hl_a');
            $table->integer('wna_l_hl_d');
            $table->integer('wna_p_hl_a');
            $table->integer('wna_p_hl_d');
            $table->integer('jml_hl_l');
            $table->integer('jml_hl_p');

            $table->integer('wni_l_pkwt_a');
            $table->integer('wni_l_pkwt_d');
            $table->integer('wni_p_pkwt_a');
            $table->integer('wni_p_pkwt_d');
            $table->integer('wna_l_pkwt_a');
            $table->integer('wna_l_pkwt_d');
            $table->integer('wna_p_pkwt_a');
            $table->integer('wna_p_pkwt_d');
            $table->integer('jml_pkwt_l');
            $table->integer('jml_pkwt_p');

            $table->integer('wni_l_pkwtt_a');
            $table->integer('wni_l_pkwtt_d');
            $table->integer('wni_p_pkwtt_a');
            $table->integer('wni_p_pkwtt_d');
            $table->integer('wna_l_pkwtt_a');
            $table->integer('wna_l_pkwtt_d');
            $table->integer('wna_p_pkwtt_a');
            $table->integer('wna_p_pkwtt_d');
            $table->integer('jml_pkwtt_l');
            $table->integer('jml_pkwtt_p');

            $table->string('gaya_gerak', 255);
            $table->string('jns_pesawat_tenaga', 255);
            $table->integer('jml_pesawat_tenaga');
            $table->string('bahan_baku', 255);
            $table->string('status', 255);
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
        Schema::dropIfExists('sim_akta_pengawasan');
    }
}
