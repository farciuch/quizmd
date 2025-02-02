<?php

namespace App\Http\Controllers;

use App\Models\ZgloszeniePytania;
use App\Models\PoziomTrudnosci;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ZgloszenieOdpowiedzi;
class QuestionReportController extends Controller
{
    public function create()
    {
        // Pobranie wszystkich poziomów trudności
        $poziomy = PoziomTrudnosci::all();

        return view('reports.create', compact('poziomy'));
    }

    /**
     * Zapisanie nowego zgłoszenia pytania wraz z odpowiedziami.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Tresc_zgloszenia' => 'required|string',
            'IdPoziom' => 'required|exists:poziomy_trudnosci,IdPoziom',
            'odpowiedzi' => 'required|array|min:4',
            'odpowiedzi.*.Tresc' => 'required|string',
            'correct_answer' => 'required|integer|min:0|max:3',
        ]);
    
        // Zapis pytania
        $zgloszeniePytania = ZgloszeniePytania::create([
            'Tresc_zgloszenia' => $validatedData['Tresc_zgloszenia'],
            'IdPoziom' => $validatedData['IdPoziom'],
            'IdUzytkownik' => Auth::id(),
        ]);
    
        // Zapis odpowiedzi
        foreach ($validatedData['odpowiedzi'] as $index => $odpowiedz) {
            ZgloszenieOdpowiedzi::create([
                'Tresc_zgloszenia_odpowiedzi' => $odpowiedz['Tresc'],
                'Czy_poprawna' => $index == $validatedData['correct_answer'] ? 1 : 0,
                'IdZgloszenie_pytania' => $zgloszeniePytania->IdZgloszenie_pytania,
            ]);
        }
    
        return redirect()->route('reports.create')->with('success', 'Pytanie zostało zgłoszone.');
    }
    
}
