@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-center align-items-center">
        <span id="timer" class="badge bg-danger fs-5"></span>
    </div>

    <div class="quiz-container text-center mt-4">
        <h4>{{ $currentQuestion->Pytanie }}</h4>

        <div class="progress my-3">
            <div id="progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 100%;" 
                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <form action="{{ route('quiz.checkAnswer') }}" method="POST" id="quiz-form">
            @csrf
            <div class="row">
                @foreach($currentQuestion->odpowiedzi as $answer)
                <div class="col-md-6 mt-2">
                    <button type="submit" name="answer" value="{{ $answer->Odpowiedz }}" class="btn btn-primary btn-block">
                        {{ $answer->Odpowiedz }}
                    </button>
                </div>
                @endforeach
            </div>
        </form>
    </div>
</div>

<script>
    let timeLeft = {{ $timeLeft }};
    const timerElement = document.getElementById('timer');
    const progressBar = document.getElementById('progress-bar');
    const quizForm = document.getElementById('quiz-form');
    let timerInterval;
    function updateTimer() {
        if (timeLeft > 0) {
            timeLeft--;
            timerElement.textContent = `${timeLeft} sek.`;
            progressBar.style.width = `${(timeLeft / 30) * 100}%`;
           
        } else {
            clearInterval(timerInterval);
            timerElement.textContent = 'Koniec czasu!';
            quizForm.submit();
        }
    }

    timerElement.textContent = `${timeLeft} sek.`;
    timerInterval = setInterval(updateTimer, 1000);
</script>
@endsection