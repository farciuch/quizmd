<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pytania', function (Blueprint $table) {
            $table->id('IdPytania');
            $table->string('Pytanie');
            $table->unsignedBigInteger('IdPoziom'); 
            $table->foreign('IdPoziom')
                  ->references('IdPoziom')
                  ->on('poziomy_trudnosci')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pytania');
    }
};
