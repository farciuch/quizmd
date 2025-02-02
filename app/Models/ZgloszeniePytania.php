<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZgloszeniePytania extends Model
{
    use HasFactory;
    protected $table = 'zgloszenia_pytan';

    protected $primaryKey = 'IdZgloszenie_pytania';
    protected $fillable = [
        'IdUzytkownik',
        'Tresc_zgloszenia',
        'IdPoziom',
    ];

    public function uzytkownik()
    {
        return $this->belongsTo(User::class, 'IdUzytkownik');
    }

    public function poziomTrudnosci()
    {
        return $this->belongsTo(PoziomTrudnosci::class, 'IdPoziom','IdPoziom');
    }

    public function zgloszeniaOdpowiedzi()
    {
        return $this->hasMany(ZgloszenieOdpowiedzi::class, 'IdZgloszenie_pytania');
    }
}
