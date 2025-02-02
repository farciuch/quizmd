@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Dodaj nowe pytanie</h2>

    <form action="{{ route('admin.questions.store') }}" method="POST">
        @csrf
        
        <!-- Treść zgłoszenia -->
        <div class="mb-3">
            <label for="Pytanie" class="form-label">Treść pytania</label>
            <textarea class="form-control" id="Pytanie" name="Pytanie" required></textarea>
        </div>

        <!-- Poziom trudności -->
        <div class="mb-3">
            <label for="IdPoziom" class="form-label">Poziom trudności</label>
            <select class="form-select" id="IdPoziom" name="IdPoziom" required>
                <option value="">Wybierz poziom</option>
                @foreach($poziomy as $poziom)
                    <option value="{{ $poziom->IdPoziom }}">{{ $poziom->Trudnosc }}</option>
                @endforeach
            </select>
        </div>

        <!-- Odpowiedzi -->
        <h4>Dodaj odpowiedzi:</h4>
        <div id="answers-section">
            @for ($i = 0; $i < 4; $i++)
            <div class="mb-3">
                <label for="odpowiedzi[{{ $i }}][Tresc]" class="form-label">Odpowiedź {{ $i + 1 }}</label>
                <input type="text" class="form-control" name="odpowiedzi[{{ $i }}][Tresc]" required>
                
                <!-- Radio button dla poprawnej odpowiedzi -->
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="correct_answer" value="{{ $i }}" id="correct{{ $i }}">
                    <label class="form-check-label" for="correct{{ $i }}">
                        Oznacz jako poprawna
                    </label>
                </div>
            </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-primary">Dodaj pytanie</button>
    </form>
</div>
@endsection
