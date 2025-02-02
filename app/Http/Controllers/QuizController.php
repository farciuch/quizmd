<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pytanie;
use App\Models\PoziomTrudnosci;
use App\Models\Odpowiedz;
use App\Models\Ranking;
use Illuminate\Support\Facades\Auth;


class QuizController extends Controller
{
    public function selectLevel()
    {
        $difficultyLevels = PoziomTrudnosci::all();
        return view('quiz.selectLevel', compact('difficultyLevels'));
    }

    public function startQuiz(Request $request)
    {
        $difficultyLevels = PoziomTrudnosci::pluck('Trudnosc')->toArray();
    
        $request->validate([
           'difficulty' => 'required|in:' . implode(',', $difficultyLevels),
         ]);
      
        $difficulty = $request->difficulty;
            $level = PoziomTrudnosci::where('Trudnosc', $difficulty)->first();
            $levelId = $level->IdPoziom;
       
        $questionsQuery = Pytanie::query();
            $questionsQuery->whereHas('poziomTrudnosci', function ($query) use ($difficulty) {
                $query->where('Trudnosc', $difficulty);
            });
       
        $questions = $questionsQuery->with('odpowiedzi')->inRandomOrder()->take(10)->get();


        if ($questions->isEmpty()) {
            return redirect()->route('quiz.selectLevel')
                ->with('error', 'Nie znaleziono pytań dla wybranego poziomu trudności.');
        }
        $questionStartTime = time();
        session([
            'quiz_questions' => $questions,
            'quiz_index' => 0,
            'quiz_score' => 0,
            'question_start_time' => $questionStartTime, 
            'level_id' => $levelId,
        ]);

        return redirect()->route('quiz.play');
    }

    public function playQuiz(Request $request)
    {
        $questions = session('quiz_questions', []);
        $index = session('quiz_index', 0);
        
        if ($index >= count($questions)) {
            return redirect()->route('quiz.end');
        }
        $questionStartTime = session('question_start_time',time());
        $timeLeft = 30 - (time() - $questionStartTime);
        $currentQuestion = $questions[$index];


        if ($timeLeft <= 0) {
            return $this->checkAnswer($request); 
        }
           
        return view('quiz.play', compact('currentQuestion', 'timeLeft'));
    }
        

    public function checkAnswer(Request $request)
    {
        $questions = session('quiz_questions', []);
        $index = session('quiz_index', 0);
        $score = session('quiz_score', 0);
    
        if ($index >= count($questions)) {
            return redirect()->route('quiz.end');
        }
    
        $question = $questions[$index];
           
        $correctAnswer = $question->odpowiedzi->where('Czy_poprawna', true)->first();

        if(time() - session('question_start_time') > 30){
             session(['quiz_index' => ++$index]);
             return redirect()->route('quiz.play')->with('message', 'Ups. Czas minął!'); 
         }
              
        if ($request->has('answer') && $correctAnswer && $request->answer === $correctAnswer->Odpowiedz) {
            session(['quiz_score' => ++$score]);
            session(['quiz_index' => ++$index]);
             session(['question_start_time' => time()]); // Reset czasu dla nowego pytania
            return redirect()->route('quiz.play');
        } else {
          session(['quiz_index' => ++$index]);
          return redirect()->route('quiz.end')->with('message', 'Ups. Błędna odpowiedź.');
        }
    }

    public function endQuiz(Request $request)
    {
         $score = session('quiz_score', 0);
         $userId = Auth::id();
         $levelId = session('level_id');
           
        // Pobierz aktualny rekord rankingowy użytkownika dla danego poziomu trudności
        $ranking = Ranking::where('IdUzytkownik', $userId)
                ->where('IdPoziom', $levelId)
                         ->first();

        if ($ranking) {
           if ($score > $ranking->Suma_punktow) {
              $ranking->update(['Suma_punktow' => $score]);
           }
        } else {
            Ranking::create([
                'IdUzytkownik' => $userId,
                'Suma_punktow' => $score,
                'IdPoziom' => $levelId,
            ]);
         }
         session()->forget(['quiz_questions', 'quiz_index', 'quiz_score', 'question_start_time','level_id']);
         $message = $request->session()->get('message');
         return view('quiz.end', compact('score','message'));
    }
}