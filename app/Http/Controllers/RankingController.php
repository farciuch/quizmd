<?php

namespace App\Http\Controllers;
use App\Models\Ranking;
use App\Models\PoziomTrudnosci;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RankingController extends Controller
{
    public function index()
    {
          $levels = PoziomTrudnosci::all(); // Pobierz wszystkie poziomy trudności

        $rankings = [];
        foreach ($levels as $level) {
              // Pobierz ranking dla danego poziomu trudności, uzywając zapytania do bazy danych z LEFT JOIN.
            $rankings[$level->Trudnosc] = Ranking::select('uzytkownicy.name', 'ranking.Suma_punktow')
                ->join('uzytkownicy', 'ranking.IdUzytkownik', '=', 'uzytkownicy.id')
                ->where('ranking.IdPoziom', $level->IdPoziom)
                ->orderByDesc('ranking.Suma_punktow')
                ->get();
        }


        return view('ranking.index', compact('rankings'));
    }
}
