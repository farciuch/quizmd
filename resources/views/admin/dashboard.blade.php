@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Panel Administratora</h1>

    <div class="mt-5 d-flex flex-column align-items-center">
        <!-- Ranking -->
        <a href="{{ route('ranking') }}" class="btn btn-primary mb-3" style="width: 300px;">Ranking</a>

        <!-- Przeglądanie zgłoszeń z pytaniami -->
        <a href="{{ route('admin.reports.index') }}" class="btn btn-warning mb-3" style="width: 300px;">Przeglądanie zgłoszeń z pytaniami</a>

        <!-- Przeglądanie bazy pytań -->
        <a href="{{ route('admin.questions.index') }}" class="btn btn-success" style="width: 300px;">Przeglądanie bazy pytań</a>
    </div>
</div>
@endsection
