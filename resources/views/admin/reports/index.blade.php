@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Zgłoszenia z Pytaniami</h1>
    
    <form action="{{ route('admin.reports.action') }}" method="POST">
        @csrf

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Treść zgłoszenia</th>
                    <th>Użytkownik</th>
                    <th>Poziom Trudności</th>
                    <th>Data zgłoszenia</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>
                        <input type="checkbox" name="reports[]" value="{{ $report->IdZgloszenie_pytania }}">
                    </td>
                    <td>{{ $report->Tresc_zgloszenia }}</td>
                    <td>{{ $report->uzytkownik->name }}</td>
                    <td>{{ $report->poziomTrudnosci->Trudnosc }}</td>
                    <td>{{ $report->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.reports.show', $report->IdZgloszenie_pytania) }}" class="btn btn-info btn-sm">Szczegóły</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="form-group mt-3">
            <button type="submit" name="action" value="accept" class="btn btn-success">Przyjmij zaznaczone</button>
            <button type="submit" name="action" value="reject" class="btn btn-danger">Odrzuć zaznaczone</button>
        </div>
    </form>

</div>
<script>
    document.getElementById('select-all').addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('input[name="reports[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });
</script>
@endsection
