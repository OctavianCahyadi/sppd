<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSppd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_sppd', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->date('tgl_surat');
            $table->date('tgl_pergi');
            $table->date('tgl_kembali');
            $table->string('acara');
            $table->string('tujuan');
            $table->string('angkutan');
            $table->string('tempat_berangkat');
            $table->integer('lama');
            $table->integer('pptk');
            $table->integer('daerah');
            $table->integer('anggaran');
            $table->string('nama_petugas');
            $table->string('nip_petugas');
            $table->string('jabatan_petugas');            
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
        Schema::dropIfExists('table_sppd');
    }
}
