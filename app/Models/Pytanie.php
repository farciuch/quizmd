<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pytanie extends Model
{
    use HasFactory;
    protected $table = 'pytania'; // Określenie nazwy tabeli
    protected $primaryKey = 'IdPytania';
    protected $fillable = [
        'Pytanie',
        'IdPoziom',
        
    ];
    public function poziomTrudnosci()
    {
        return $this->belongsTo(PoziomTrudnosci::class, 'IdPoziom', 'IdPoziom');
    }

    public function odpowiedzi()
    {
        return $this->hasMany(Odpowiedz::class, 'IdPytania');
    }
}
