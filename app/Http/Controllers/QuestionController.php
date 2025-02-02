<?php

namespace App\Http\Controllers;

use App\Models\Odpowiedz;
use Illuminate\Http\Request;
use App\Models\Pytanie;
use App\Models\PoziomTrudnosci;
use Illuminate\Support\Facades\Auth;
class QuestionController extends Controller
{
    public function index()
    {
        $questions = Pytanie::with('poziomTrudnosci')->get();
        return view('admin.questions.index', compact('questions'));
    }
    public function edit($id)
    {
        $question = Pytanie::with(['odpowiedzi', 'poziomTrudnosci'])->findOrFail($id);
        $difficultyLevels = PoziomTrudnosci::all();
        return view('admin.questions.edit', compact('question', 'difficultyLevels'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'Pytanie' => 'required|string|max:255',
            'IdPoziom' => 'required|exists:poziomy_trudnosci,IdPoziom',
            'odpowiedzi' => 'required|array|min:4|max:4',
            'odpowiedzi.*' => 'required|string|max:255',
            'poprawna_odpowiedz' => 'required|in:0,1,2,3',
        ]);

        $question = Pytanie::findOrFail($id);
        $question->update([
            'Pytanie' => $request->Pytanie,
            'IdPoziom' => $request->IdPoziom,
        ]);

        // Aktualizacja odpowiedzi
        foreach ($question->odpowiedzi as $index => $odpowiedz) {
            $odpowiedz->update([
                'Odpowiedz' => $request->odpowiedzi[$index],
                'Czy_poprawna' => $index == $request->poprawna_odpowiedz,
            ]);
        }

        return redirect()->route('admin.questions.index')->with('success', 'Pytanie zostało zaktualizowane.');
    }

    public function bulkDelete(Request $request)
{
    $request->validate([
        'questions' => 'required|array', // Sprawdzenie, czy wybrano pytania
    ]);

    Pytanie::whereIn('IdPytania', $request->questions)->delete(); // Usunięcie wybranych pytań

    return redirect()->route('admin.questions.index')->with('success', 'Wybrane pytania zostały usunięte.');
}
public function create()
{   $poziomy = PoziomTrudnosci::all();
    return view('admin.questions.create', compact('poziomy'));
}
public function store(Request $request)
{
    $validatedData = $request->validate([
        'Pytanie' => 'required|string',
        'IdPoziom' => 'required|exists:poziomy_trudnosci,IdPoziom',
        'odpowiedzi' => 'required|array|min:4',
        'odpowiedzi.*.Tresc' => 'required|string',
        'correct_answer' => 'required|integer|min:0|max:3',
    ]);

    // Zapis pytania
    $pytanie = Pytanie::create([
        'Pytanie' => $validatedData['Pytanie'],
        'IdPoziom' => $validatedData['IdPoziom'],
       
    ]);

    // Zapis odpowiedzi
    foreach ($validatedData['odpowiedzi'] as $index => $odpowiedzka) {
        Odpowiedz::create([
            'Odpowiedz' => $odpowiedzka['Tresc'],
            'Czy_poprawna' => $index == $validatedData['correct_answer'] ? 1 : 0,
            'IdPytania' => $pytanie->IdPytania,
        ]);
    }

    return redirect()->route('admin.questions.create')->with('success', 'Pytanie zostało dodane.');
}




}
