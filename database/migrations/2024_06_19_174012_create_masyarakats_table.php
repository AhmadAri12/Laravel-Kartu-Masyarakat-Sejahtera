<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasyarakatsTable extends Migration
{
    public function up()
    {
        Schema::create('masyarakats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nomor_kartu_keluarga')->unique();
            $table->string('nama_kepala_keluarga');
            $table->string('nama_istri')->nullable();
            $table->integer('saudara');
            $table->integer('jumlah_anak');
            $table->decimal('biaya_kebutuhan_tiap_bulan', 15, 2);
            $table->decimal('biaya_sekolah_anak', 15, 2)->nullable();
            $table->decimal('pendapatan_keluarga', 15, 2);
            $table->string('status_tempat_tinggal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('masyarakats');
    }
}

