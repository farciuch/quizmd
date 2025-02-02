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
        Schema::create('ranking', function (Blueprint $table) {
            $table->id('IdRanking');
            $table->foreignId('IdUzytkownik')->constrained('uzytkownicy')->onDelete('cascade');
            $table->unsignedBigInteger('IdPoziom')->nullable(); 
            $table->foreign('IdPoziom')
                  ->references('IdPoziom')
                  ->on('poziomy_trudnosci')
                  ->onDelete('cascade');
            $table->integer('Suma_punktow');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranking');
    }
};
