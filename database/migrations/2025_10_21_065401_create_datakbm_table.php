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
        Schema::create('datakbm', function (Blueprint $table) {
            $table->id('idkbm');
            $table->unsignedBigInteger('idguru');
            $table->unsignedBigInteger('idwalas');
            $table->string('hari');
            $table->time('mulai');
            $table->time('selesai');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('idguru')->references('idguru')->on('dataguru')->onDelete('cascade');
            $table->foreign('idwalas')->references('idwalas')->on('datawalas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datakbm');
    }
};
