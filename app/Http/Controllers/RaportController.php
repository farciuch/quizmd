<?php

namespace App\Http\Controllers;
use App\Models\ZgloszeniePytania;
use Illuminate\Http\Request;
use App\Models\Pytanie;
use App\Models\Odpowiedz;


class RaportController extends Controller
{
    public function index()
    {
        $reports = ZgloszeniePytania::with('uzytkownik', 'poziomTrudnosci')->get();
        return view('admin.reports.index', compact('reports'));
    }
    public function show($id)
    {
        $report = ZgloszeniePytania::with(['uzytkownik', 'poziomTrudnosci'])->findOrFail($id);
        return view('admin.reports.show', compact('report'));
    }
    public function handleAction(Request $request)
    {
        $request->validate([
            'reports' => 'required|array',
            'action' => 'required|in:accept,reject',
        ]);
    
        $reports = ZgloszeniePytania::whereIn('IdZgloszenie_pytania', $request->reports)->get();
    
        foreach ($reports as $report) {
            if ($request->action === 'accept') {
                // Tworzenie pytania
                $pytanie = Pytanie::create([
                    'Pytanie' => $report->Tresc_zgloszenia,
                    'IdPoziom' => $report->IdPoziom,
                ]);
    
                // Przeniesienie odpowiedzi
                foreach ($report->zgloszeniaOdpowiedzi as $odpowiedz) {
                    Odpowiedz::create([
                        'Odpowiedz' => $odpowiedz->Tresc_zgloszenia_odpowiedzi,
                        'Czy_poprawna' => $odpowiedz->Czy_poprawna,
                        'IdPytania' => $pytanie->IdPytania,
                    ]);
                }
    
                // Usunięcie zgłoszenia i powiązanych odpowiedzi
                $report->zgloszeniaOdpowiedzi()->delete();
                $report->delete();
    
            } elseif ($request->action === 'reject') {
                // Usunięcie zgłoszenia i powiązanych odpowiedzi
                $report->zgloszeniaOdpowiedzi()->delete();
                $report->delete();
            }
        }
    
        return redirect()->route('admin.reports.index')->with('success', 'Wybrane zgłoszenia zostały zaktualizowane.');
    }
    

    public function accept($id)
    {
        $report = ZgloszeniePytania::with('zgloszeniaOdpowiedzi')->findOrFail($id);
    
        // Tworzenie pytania
        $pytanie = Pytanie::create([
            'Pytanie' => $report->Tresc_zgloszenia,
            'IdPoziom' => $report->IdPoziom,
        ]);
    
        // Przeniesienie odpowiedzi
        foreach ($report->zgloszeniaOdpowiedzi as $odpowiedz) {
            Odpowiedz::create([
                'Odpowiedz' => $odpowiedz->Tresc_zgloszenia_odpowiedzi,
                'Czy_poprawna' => $odpowiedz->Czy_poprawna,
                'IdPytania' => $pytanie->IdPytania,
            ]);
        }
    
        // Usunięcie zgłoszenia i powiązanych odpowiedzi
        $report->zgloszeniaOdpowiedzi()->delete();
        $report->delete();
    
        return redirect()->route('admin.reports.index')->with('success', 'Pytanie zostało zaakceptowane i przeniesione do bazy pytań.');
    }

public function reject($id)
{
    // Pobierz zgłoszenie wraz z powiązanymi odpowiedziami
    $report = ZgloszeniePytania::with('zgloszeniaOdpowiedzi')->findOrFail($id);

    // Usuń odpowiedzi powiązane ze zgłoszeniem
    $report->zgloszeniaOdpowiedzi()->delete();

    // Usuń zgłoszenie
    $report->delete();

    return redirect()->route('admin.reports.index')->with('success', 'Zgłoszenie zostało odrzucone.');
}

}
