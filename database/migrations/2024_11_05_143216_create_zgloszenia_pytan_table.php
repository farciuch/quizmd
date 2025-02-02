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
        Schema::create('zgloszenia_pytan', function (Blueprint $table) {
            $table->id('IdZgloszenie_pytania');
            $table->string('Tresc_zgloszenia');
         $table->foreignId('IdUzytkownik')->constrained('uzytkownicy')->onDelete('cascade');
                  
            $table->unsignedBigInteger(column: 'IdPoziom'); 
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
        Schema::dropIfExists('zgloszenia_pytan');
    }
};
