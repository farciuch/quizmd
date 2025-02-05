@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Edytuj profil</h2>

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('patch')

        <!-- Zmiana Nazwy -->
        <div class="form-group mt-4">
            <label for="name">Nazwa:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
        </div>
        
        <!-- Zmiana Hasła -->
        <div class="form-group mt-3">
            <label for="password">Nowe Hasło:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nowe hasło">
        </div>
        
        <div class="form-group mt-3">
            <label for="password_confirmation">Potwierdź nowe hasło:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Potwierdź nowe hasło">
        </div>

        <!-- Zapisanie Danych -->
        <button type="submit" class="btn btn-primary mt-4">Zapisz zmiany</button>
        <button class="btn btn-danger mt-4" onclick="confirmDelete()">Usuń konto</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-4 d-md-none">Powrót do menu</a>
    </form>




 <div id="deleteModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h3>Czy na pewno chcesz usunąć konto?</h3>
        <form action="{{ route('profile.delete') }}" method="POST">
            @csrf
            @method('DELETE')

            <!-- Pole do wprowadzenia hasła -->
            <div class="form-group mt-3">
                <label for="password">Podaj hasło, aby usunąć konto:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="modal-buttons"> <!-- Kontener na przyciski -->
                <button type="submit" class="btn btn-danger mt-3">Tak, usuń konto</button>
                <button type="button" class="btn btn-secondary mt-3" onclick="closeModal()">Anuluj</button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
    function confirmDelete() {
        document.getElementById('deleteModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }
</script>

<style>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1050;
    }
    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        width: auto;
        max-width: 500px;
        margin: auto;
        display: flex; 
        flex-direction: column; 
        align-items: stretch; 
    }

    .modal-buttons {
        display: flex; 
        justify-content: flex-end; 
        margin-top: 20px; 
    }

    .modal-buttons button {
        margin-left: 10px; 
    }
    .dark-mode .modal-content {
        background-color: #303030; 
        color: #e0e0e0; 
    }

    
    .dark-mode .modal-content label {
        color: #e0e0e0; 
    }

    .dark-mode .modal-content .form-control {
        background-color: #424242; 
        color: #ffffff; 
        border-color: #555; 
    }

    .dark-mode .modal-content .form-control:focus {
        background-color: #555; 
        color: #ffffff; 
        border-color: #777; 
    }
    .dark-mode .modal-content .btn-secondary {
        background-color: #555; 
        color: #fff;
        border-color: #777;
    }

    .dark-mode .modal-content .btn-secondary:hover {
        background-color: #777; 
        border-color: #999;
    }
</style>
@endsection
