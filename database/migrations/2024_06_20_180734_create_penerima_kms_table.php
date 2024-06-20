<?php

// database/migrations/xxxx_xx_xx_create_penerima_kms_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaKmsTable extends Migration
{
    public function up()
    {
        Schema::create('penerima_kms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masyarakat_id');
            $table->foreign('masyarakat_id')->references('id')->on('masyarakats')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penerima_kms');
    }
}

