@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Wybierz poziom trudności</h1>

    <form action="{{ route('quiz.start') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="difficulty">Poziom trudności</label>
            <select name="difficulty" id="difficulty" class="form-control">
                @foreach($difficultyLevels as $level)
                    <option value="{{ $level->Trudnosc }}">{{ ucfirst($level->Trudnosc) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Rozpocznij Quiz</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3 d-md-none">Powrót do menu</a>
    </form>
  
   
</div>
@endsection