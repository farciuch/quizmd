@extends('layouts.app')

@section('content')
<style>
    .ranking-table {
        border-radius: 8px; /* Delikatniejsze zaokrąglenie rogów */
        overflow: hidden;
        border-collapse: collapse; /* Łączenie krawędzi komórek */
        width: 100%;
        margin-bottom: 20px; /* Dodanie marginesu dolnego dla odstępu między tabelami */
    }

    .ranking-table th,
    .ranking-table td {
        padding: 10px 12px; /* Nieco mniejszy padding */
        text-align: left; /* Wyrównanie tekstu do lewej w komórkach danych */
        border-bottom: 1px solid #e0e0e0; /* Cienka, jasnoszara linia oddzielająca wiersze */
        white-space: nowrap; /* Zapobiega zawijaniu tekstu */
    }

    .ranking-table th {
        background-color: #f0f0f0; /* Bardzo jasne szare tło dla nagłówków */
        color: #333; /* Ciemniejszy kolor tekstu dla nagłówków */
        font-weight: 600; /* Pogrubienie tekstu w nagłówkach */
        text-align: center; /* Wyśrodkowanie tekstu w nagłówkach */
        border-bottom: 2px solid #c0c0c0; /* Grubsza, ciemniejsza linia pod nagłówkami */
    }

    .ranking-table th:first-child,
    .ranking-table td:first-child {
        text-align: center; /* Wyśrodkowanie tekstu w pierwszej kolumnie (pozycja) */
    }

    .ranking-table th:last-child,
    .ranking-table td:last-child {
        text-align: center; /* Wyśrodkowanie tekstu w ostatniej kolumnie (punkty) */
    }


    .ranking-table tbody tr:last-child th,
    .ranking-table tbody tr:last-child td {
        border-bottom: none; /* Usuwa dolną linię dla ostatniego wiersza */
    }
</style>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Ranking użytkowników</h1>
        <div class="row">
        @foreach($rankings as $level => $ranking)
           <div class="col-12 col-md-6 mb-4">
                 <h3 class="text-center mt-4">{{ ucfirst($level) }}</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered ranking-table">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 10%;">Pozycja</th>
                            <th style="width: 70%;">Użytkownik</th>
                             <th style="width: 20%;">Punkty</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($ranking as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->Suma_punktow }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Brak wyników dla tego poziomu trudności.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
        </div>

        @if (Auth::user()->isAdmin())
    
        
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3 d-md-none">Powrót do menu</a>
        @else
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3 d-md-none">Powrót do menu</a>
            @endif
    </div>
    
@endsection