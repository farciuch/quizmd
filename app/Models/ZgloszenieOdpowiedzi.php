<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ZgloszenieOdpowiedzi extends Model
{
    use HasFactory;
    protected $table = 'zgloszenia_odpowiedzi';

    protected $primaryKey = 'IdZgloszenia_odpowiedzi';
    protected $fillable = [
        'Tresc_zgloszenia_odpowiedzi',
        'Czy_poprawna',
        'IdZgloszenie_pytania',
    ];
    public function zgloszeniePytania()
    {
        return $this->belongsTo(ZgloszeniePytania::class, 'IdZgloszenie_pytania');
    }
}
