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
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('gambar')->nullable();
            $table->String('nama')->unique();
            $table->String('slug')->unique();
            $table->String('brand');
            $table->String('dimensi');
            $table->String('berat');
            $table->String('material');
            $table->text('layar');
            $table->String('os');
            $table->String('soc');
            $table->String('ramstorage');
            $table->String('kamerautama');
            $table->String('kameraultrawide')->nullable();
            $table->String('kameratelephoto')->nullable();
            $table->String('kameraperiscope')->nullable();
            $table->String('makro')->nullable();
            $table->String('depth')->nullable();
            $table->String('videobelakang')->nullable();
            $table->String('kameradepan');
            $table->String('videodepan')->nullable();
            $table->String('speaker');
            $table->String('audiojack');
            $table->String('konektivitas');
            $table->String('sensor');
            $table->String('baterai');
            $table->String('charging');
            $table->String('harga')->nullable();
        });

      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phones');
    }
};
