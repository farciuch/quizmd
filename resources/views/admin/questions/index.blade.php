@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Baza Pytań</h1>
    
    <div class="mb-3">
        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">Dodaj nowe pytanie</a>
    </div>

    <form action="{{ route('admin.questions.bulkDelete') }}" method="POST">
        @csrf

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Pytanie</th>
                    <th>Poziom Trudności</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                <tr>
                    <td>
                        <input type="checkbox" name="questions[]" value="{{ $question->IdPytania }}">
                    </td>
                    <td>{{ $question->Pytanie }}</td>
                    <td>{{ $question->poziomTrudnosci->Trudnosc ?? 'Brak' }}</td>
                    <td>
                        <a href="{{ route('admin.questions.edit', $question->IdPytania) }}" class="btn btn-info btn-sm">Edytuj</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-danger">Usuń zaznaczone</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('select-all').addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('input[name="questions[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });
</script>
@endsection
