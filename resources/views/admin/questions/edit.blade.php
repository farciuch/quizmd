@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Edytuj pytanie</h1>

    <form action="{{ route('admin.questions.update', $question->IdPytania) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Treść pytania -->
        <div class="form-group mb-3">
            <label for="Pytanie">Treść pytania:</label>
            <input type="text" class="form-control" id="Pytanie" name="Pytanie" value="{{ $question->Pytanie }}" required>
        </div>

        <!-- Poziom trudności -->
        <div class="form-group mb-3">
            <label for="IdPoziom">Poziom trudności:</label>
            <select class="form-control" id="IdPoziom" name="IdPoziom" required>
                @foreach($difficultyLevels as $level)
                    <option value="{{ $level->IdPoziom }}" 
                            {{ $question->IdPoziom == $level->IdPoziom ? 'selected' : '' }}>
                        {{ $level->Trudnosc }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Odpowiedzi -->
        <div class="form-group mb-3">
            <label>Odpowiedzi:</label>
            @foreach($question->odpowiedzi as $index => $odpowiedz)
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="odpowiedzi[]" value="{{ $odpowiedz->Odpowiedz }}" required>
                    <div class="input-group-text">
                        <input type="radio" name="poprawna_odpowiedz" value="{{ $index }}" 
                               {{ $odpowiedz->Czy_poprawna ? 'checked' : '' }}> Poprawna
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Przycisk zapisu -->
        <button type="submit" class="btn btn-success">Zapisz zmiany</button>
        <a href="{{ route('admin.questions.index') }}" class="btn btn-secondary d-md-none">Powrót</a>
    </form>
</div>
@endsection
