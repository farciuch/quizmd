@extends('layouts.app')

@section('content')
<style>
    .dashboard-button {
        width: 300px;
        padding: 15px 20px;
        font-size: 1.2rem;
        border-radius: 10px;
        text-align: center;
        font-weight: 600;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border: none;
    }

    .dashboard-button:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .dashboard-button.btn-success {
        background-color: #28a745;
        color: white;
    }

    .dashboard-button.btn-primary {
        background-color: #007bff;
        color: white;
    }

    .dashboard-button.btn-warning {
        background-color: #ffc107;
        color: #333;
    }

    /* Style dla Dark Mode */
    body.dark-mode .dashboard-button {
        box-shadow: none;
        border: 1px solid #555;
    }
    body.dark-mode .dashboard-button.btn-success {
        background-color: #30663a;
        color: #e0e0e0;
    }

    body.dark-mode .dashboard-button.btn-primary {
        background-color: #004d99;
        color: #e0e0e0;
    }

    body.dark-mode .dashboard-button.btn-warning {
        background-color: #b28704;
        color: #e0e0e0;
    }
</style>

<div class="container mt-5">

    <h1 class="text-center">Panel administratora</h1>

    <div class="mt-5 d-flex flex-column align-items-center">
        <!-- Ranking -->
        <a href="{{ route('ranking') }}" class="btn btn-primary mb-3 dashboard-button">Ranking</a>

        <!-- Przeglądanie zgłoszeń z pytaniami -->
        <a href="{{ route('admin.reports.index') }}" class="btn btn-warning mb-3 dashboard-button">Przeglądanie zgłoszeń z pytaniami</a>

        <!-- Przeglądanie bazy pytań -->
        <a href="{{ route('admin.questions.index') }}" class="btn btn-success dashboard-button">Przeglądanie bazy pytań</a>
    </div>
</div>
@endsection