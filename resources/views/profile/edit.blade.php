@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Edytuj Profil</h2>

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
            <label for="password_confirmation">Potwierdź Nowe Hasło:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Potwierdź nowe hasło">
        </div>

        <!-- Zapisanie Danych -->
        <button type="submit" class="btn btn-primary mt-4">Zapisz zmiany</button>
    </form>

    <!-- Przycisk do Usuwania Konta -->
    <div class="mt-5">
        <button class="btn btn-danger" onclick="confirmDelete()">Usuń Konto</button>
    </div>

    <!-- Modal do potwierdzenia usunięcia konta -->
 <!-- Modal do potwierdzenia usunięcia konta -->
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

            <button type="submit" class="btn btn-danger mt-3">Tak, usuń konto</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Anuluj</button>
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
    }
    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
    }
</style>
@endsection
