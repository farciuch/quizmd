@extends('layouts.app')

@section('content')
<style>
    .dashboard-button {
        width: 300px; /* Ustawienie stałej szerokości */
        padding: 15px 20px; /* Większy padding wewnątrz przycisków */
        font-size: 1.2rem; /* Większa czcionka */
        border-radius: 10px; /* Zaokrąglone rogi */
        text-align: center; /* Wyśrodkowanie tekstu */
        font-weight: 600; /* Pogrubienie tekstu */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); /* Subtelny cień */
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out; /* Animacje hover */
        border: none; /* Usunięcie domyślnej ramki buttona */
    }

    .dashboard-button:hover {
        transform: scale(1.05); /* Efekt "powiększenia" na hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Mocniejszy cień na hover */
    }

    .dashboard-button.btn-success {
        background-color: #28a745; /* Zielony */
        color: white;
    }

    .dashboard-button.btn-primary {
        background-color: #007bff; /* Niebieski */
        color: white;
    }

    .dashboard-button.btn-warning {
        background-color: #ffc107; /* Żółty */
        color: #333; /* Ciemniejszy kolor tekstu dla żółtego przycisku */
    }

    /* Style dla Dark Mode (jeśli chcesz, aby przyciski też zmieniały wygląd w Dark Mode) */
    body.dark-mode .dashboard-button {
        box-shadow: none; /* Usuń cień w dark mode (opcjonalnie) */
        border: 1px solid #555; /* Dodaj delikatną ramkę w dark mode (opcjonalnie) */
    }
    body.dark-mode .dashboard-button.btn-success {
        background-color: #30663a; /* Ciemniejszy zielony w dark mode */
        color: #e0e0e0;
    }

    body.dark-mode .dashboard-button.btn-primary {
        background-color: #004d99; /* Ciemniejszy niebieski w dark mode */
        color: #e0e0e0;
    }

    body.dark-mode .dashboard-button.btn-warning {
        background-color: #b28704; /* Ciemniejszy żółty/złoty w dark mode */
        color: #e0e0e0;
    }
</style>

<div class="container mt-5">

    <div class="mt-5 d-flex flex-column align-items-center">
        <button class="btn btn-success dashboard-button mb-3" onclick="window.location.href='{{ route('quiz.selectLevel') }}'">Rozpocznij Quiz</button>

        <button class="btn btn-primary dashboard-button mb-3" onclick="window.location.href='{{ route('ranking') }}'">Ranking</button>

        <button class="btn btn-warning dashboard-button" onclick="window.location.href='{{ route('reports.create') }}'">Zgłoś Nowe Pytanie</button>

    </div>
</div>
@endsection