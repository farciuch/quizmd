<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PoziomTrudnosci extends Model
{
    use HasFactory;
    protected $table = 'poziomy_trudnosci';
    protected $primaryKey = 'IdPoziom';
    protected $fillable = [
        'Trudnosc'
        
    ];

    public function pytania()
    {
        return $this->hasMany(Pytanie::class, 'IdPoziom');
    }

    public function zgloszeniaPytan()
    {
        return $this->hasMany(ZgloszeniePytania::class, 'IdPoziom');
    }
    public function ranking()
    {
        return $this->hasMany(Ranking::class, 'IdPoziom');
    }
}
