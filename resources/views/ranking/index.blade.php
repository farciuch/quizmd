@extends('layouts.app')

@section('content')
    <style>
        .ranking-table {
            border-radius: 10px;
            overflow: hidden; /* Zapewnia zaokrąglenie rogów dla całości tabeli */
        }
        .ranking-table th {
            background: linear-gradient(to right, #2980b9, #6dd5ed);
            color: white;
            text-align: center; /* Wyśrodkowanie tekstu */
            border: none; /* Usunięcie standardowych obramowań */
            padding: 12px; /* Zwiększenie paddingu */
            white-space: nowrap; /* Zapobiega zawijaniu tekstu */
        }
         .ranking-table th:first-child{
            border-top-left-radius: 10px;
        }
        .ranking-table th:last-child{
            border-top-right-radius: 10px;
        }
        .ranking-table td {
          text-align: center;
            border: none;
             padding: 10px; /* Zwiększenie paddingu */
        }

        .ranking-table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
         }
         .ranking-table tbody tr:nth-child(even) {
              background-color: #ffffff;
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
       <div class="text-center">
          <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Powrót do menu</a>
        </div>
    </div>
@endsection
