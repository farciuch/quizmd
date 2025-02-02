<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odpowiedz extends Model
{
    use HasFactory;
    protected $table = 'odpowiedzi';
    protected $primaryKey = 'IdOdpowiedzi';
    protected $fillable = [
        'Odpowiedz',
        'Czy_poprawna',
        'IdPytania'
        
    ];
    public function pytanie()
    {
        return $this->belongsTo(Pytanie::class, 'IdPytania');
    }
}
