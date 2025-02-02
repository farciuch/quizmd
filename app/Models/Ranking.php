<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
  use HasFactory;
  protected $table = 'ranking';
  protected $primaryKey = 'IdRanking';
  protected $fillable = [
    'IdUzytkownik',
    'Suma_punktow',
    'IdPoziom'
];

public function uzytkownik()
{
    return $this->belongsTo(User::class, 'IdUzytkownik');
}
public function poziom_trudnosci()
{
    return $this->belongsTo(PoziomTrudnosci::class, 'IdPoziom');
}
}
