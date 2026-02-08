<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\Answer;
use App\Models\Snippet;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Quiz extends Component
{
    public ?int $currentSnippetId = null;
    public ?string $currentCode = null;
    public ?string $correctAnswer = null;
    public array $options = [];
    public ?int $gameId = null;
    public int $score = 0;
    public int $questionNumber = 1;
    public int $totalQuestions = 10;
    public ?string $feedback = null;
    public bool $answered = false;
    public ?string $selectedAnswer = null;
    public bool $gameCompleted = false;

    public function mount()
    {
        Log::info('Quiz component mounted');
        $this->startNewGame();
    }

    public function startNewGame()
    {
        Log::info('🆕 Starting new game');

        $game = Game::create([
            'user_id' => auth()->id(),
            'score' => 0,
        ]);

        $this->gameId = $game->id;
        $this->score = 0;
        $this->questionNumber = 1;
        $this->gameCompleted = false;
        $this->feedback = null;
        $this->answered = false;
        $this->selectedAnswer = null;
        $this->loadNextQuestion();
    }

    public function loadNextQuestion()
    {
        Log::info('Loading next question', [
            'questionNumber' => $this->questionNumber,
            'totalQuestions' => $this->totalQuestions,
        ]);

        if ($this->questionNumber > $this->totalQuestions) {
            Log::info('🏁 Game completed');
            $this->gameCompleted = true;
            Game::find($this->gameId)?->update(['score' => $this->score]);
            return;
        }

        $answeredSnippetIds = Answer::where('game_id', $this->gameId)
            ->pluck('snippet_id')
            ->toArray();

        Log::info('Already answered snippet IDs', ['ids' => $answeredSnippetIds]);

        $snippet = Snippet::whereNotIn('id', $answeredSnippetIds)
            ->inRandomOrder()
            ->first();

        if (!$snippet) {
            Log::warning(' No unanswered snippets, using random');
            $snippet = Snippet::inRandomOrder()->first();
        }

        Log::info('Snippet loaded', [
            'id' => $snippet->id,
            'framework' => $snippet->framework,
        ]);

        $this->currentSnippetId = $snippet->id;
        $this->currentCode = $snippet->code;
        $this->correctAnswer = $snippet->getCorrectAnswer();
        $this->options = $this->generateOptions($snippet);
        $this->feedback = null;
        $this->answered = false;
        $this->selectedAnswer = null;

        Log::info('Question ready', [
            'options' => $this->options,
            'answered' => $this->answered,
        ]);
    }

    protected function generateOptions(Snippet $snippet): array
    {
        Log::info('Generating options');

        $correctAnswer = $this->correctAnswer;

        $wrongOptions = Snippet::where('id', '!=', $snippet->id)
            ->where(function ($query) use ($correctAnswer) {
                $query->where('framework', '!=', $correctAnswer)
                      ->orWhereNull('framework');
            })
            ->inRandomOrder()
            ->limit(3)
            ->get()
            ->map(fn($s) => $s->getCorrectAnswer())
            ->unique()
            ->values();

        $allFrameworks = ['React', 'Vue.js', 'Angular', 'Laravel', 'Django',
                        'Express.js', 'Spring Boot', 'Flask', 'Symfony', 'Next.js',
                        'NestJS', 'FastAPI', 'Ruby on Rails', 'Livewire', 'SolidJS'];

        while ($wrongOptions->count() < 3) {
            $random = collect($allFrameworks)
                ->diff($wrongOptions)
                ->diff([$correctAnswer])
                ->random();
            $wrongOptions->push($random);
        }

        $options = $wrongOptions->take(3)
            ->push($correctAnswer)
            ->shuffle()
            ->values()
            ->toArray();

        Log::info('Options generated', ['options' => $options]);

        return $options;
    }

    public function submitAnswer(string $answer)
    {
        Log::info(' submitAnswer called', [
            'answer' => $answer,
            'answered' => $this->answered,
            'questionNumber' => $this->questionNumber,
            'currentSnippet' => $this->currentSnippetId,
        ]);

        if ($this->answered) {
            Log::warning('Already answered, returning early');
            return;
        }

        $isCorrect = $answer === $this->correctAnswer;

        Log::info('Answer check', [
            'userAnswer' => $answer,
            'correctAnswer' => $this->correctAnswer,
            'isCorrect' => $isCorrect,
        ]);

        if ($isCorrect) {
            $this->score += 10;
            $this->feedback = 'correct';
        } else {
            $this->feedback = 'incorrect';
        }

        $this->selectedAnswer = $answer;

        Answer::create([
            'game_id' => $this->gameId,
            'snippet_id' => $this->currentSnippetId,
            'user_answer' => $answer,
            'is_correct' => $isCorrect,
        ]);

        $this->answered = true;

        Log::info('Answer saved', [
            'score' => $this->score,
            'answered' => $this->answered,
        ]);
    }

    public function nextQuestion()
    {
        Log::info(' Next question clicked', [
            'currentQuestion' => $this->questionNumber,
        ]);

        $this->questionNumber++;
        $this->loadNextQuestion();
    }

    public function render()
    {
        return view('livewire.quiz');
    }
}