<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSaudaraFromMasyarakatsTable extends Migration
{
    public function up()
    {
        Schema::table('masyarakats', function (Blueprint $table) {
            $table->dropColumn('saudara');
        });
    }

    public function down()
    {
        Schema::table('masyarakats', function (Blueprint $table) {
            $table->string('saudara')->nullable();
        });
    }
}
