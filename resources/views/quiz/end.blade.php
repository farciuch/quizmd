@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h1>Gra zakończona!</h1>
    <p>Twój wynik: <strong>{{ $score }}</strong></p>
    @if(session('message'))
    <p class="text-danger">{{ session('message') }}</p>
     @endif
    <a href="{{ route('quiz.selectLevel') }}" class="btn btn-success mt-3">Rozpocznij nową grę</a>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Zakończ grę</a>
</div>
@endsection