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
        Schema::create('zgloszenia_odpowiedzi', function (Blueprint $table) {
            $table->id('IdZgloszenia_odpowiedzi');
            $table->string('Tresc_zgloszenia_odpowiedzi');
            $table->boolean('Czy_poprawna');
            
            $table->unsignedBigInteger(column: 'IdZgloszenie_pytania'); 
            $table->foreign('IdZgloszenie_pytania')
            ->references('IdZgloszenie_pytania')
            ->on('zgloszenia_pytan')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zgloszenia_odpowiedzi');
    }
};
