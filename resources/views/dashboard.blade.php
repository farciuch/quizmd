@extends('layouts.app')

@section('content')
<div class="container mt-5">
    
    <div class="mt-5 text-center">
        <button class="btn btn-success mb-3" onclick="window.location.href='{{ route('quiz.selectLevel') }}'">Rozpocznij Quiz</button>
        <br>
        <button class="btn btn-info mb-3" onclick="window.location.href='{{ route('ranking') }}'">Ranking</button>
        <br>
        <button class="btn btn-warning" onclick="window.location.href='{{ route('reports.create') }}'">Zgłoś Nowe Pytanie</button>

    </div>
</div>
@endsection
