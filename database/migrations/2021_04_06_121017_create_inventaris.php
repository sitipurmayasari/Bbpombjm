<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventaris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->integer('harga')->default(0);
            $table->string('kode_bmn')->nullable();
            $table->string('jenis_barang')->default(0);
            $table->integer('jumlah_barang')->default(0);
            $table->date('tanggal_diterima');
            $table->string('merk')->nullable();
            $table->string('no_seri')->nullable();
            $table->string('lokasi');
            $table->string('penanggung_jawab');
            $table->string('file_user_manual')->nullable();
            $table->string('file_trouble')->nullable();
            $table->string('file_ika')->nullable();
            $table->string('file_foto')->nullable();
            $table->enum('status_barang',['baik','rusak']);
            $table->text('spesifikasi')->nullable();
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
        Schema::dropIfExists('inventaris');
    }
}
