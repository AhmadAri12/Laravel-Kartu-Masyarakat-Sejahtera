<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penerima_kms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masyarakat_id')->unique();
            $table->foreign('masyarakat_id')->references('id')->on('masyarakats')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_kms');
    }
};
