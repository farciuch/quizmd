@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Szczegóły Zgłoszenia</h1>

    <div class="card mt-4">
        <div class="card-body">
            <h4><strong>Użytkownik:</strong> {{ $report->uzytkownik->name }}</h4>
            <h4><strong>Email:</strong> {{ $report->uzytkownik->email }}</h4>
            <h4><strong>Treść Pytania:</strong></h4>
            <p>{{ $report->Tresc_zgloszenia }}</p>
            <h4><strong>Poziom trudności:</strong> {{ $report->poziomTrudnosci->Trudnosc }}</h4>
        </div>
    </div>

    <h4 class="mt-4">Odpowiedzi:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Treść Odpowiedzi</th>
                <th>Czy Poprawna</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report->zgloszeniaOdpowiedzi as $odpowiedz)
            <tr>
                <td>{{ $odpowiedz->Tresc_zgloszenia_odpowiedzi }}</td>
                <td>{{ $odpowiedz->Czy_poprawna ? 'Tak' : 'Nie' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <form action="{{ route('admin.reports.accept', $report->IdZgloszenie_pytania) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Zaakceptuj Zgłoszenie</button>
        </form>

        <form action="{{ route('admin.reports.reject', $report->IdZgloszenie_pytania) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Odrzuć Zgłoszenie</button>
        </form>

        <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">Powrót</a>
    </div>
</div>
@endsection
