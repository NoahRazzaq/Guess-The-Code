<div class="min-h-screen bg-gray-900 text-gray-100 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        @if(!$gameCompleted)
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white">Guess the Code</h1>
                    <p class="text-gray-400 mt-1">Question {{ $questionNumber }} / {{ $totalQuestions }}</p>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold text-green-400">{{ $score }}</div>
                    <div class="text-sm text-gray-400">points</div>
                </div>
            </div>

            <div class="mb-6">
                <div class="w-full bg-gray-700 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full transition-all duration-300"
                         style="width: {{ ($questionNumber - 1) / $totalQuestions * 100 }}%"></div>
                </div>
            </div>

            @if($currentSnippetId)
                <div wire:key="question-{{ $currentSnippetId }}-{{ $questionNumber }}">
                    <div class="bg-gray-800 rounded-lg p-6 mb-6 border border-gray-700">
                        <div class="mb-3 text-sm text-gray-400 font-semibold uppercase tracking-wide">
                            Code Snippet
                        </div>
                        <pre class="overflow-x-auto"><code class="text-sm font-mono text-gray-100 leading-relaxed">{{ $currentCode }}</code></pre>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-white mb-4">
                            What framework or language is this?
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        @foreach($options as $index => $option)
                            <button
                                wire:key="option-{{ $currentSnippetId }}-{{ $index }}"
                                wire:click="submitAnswer('{{ addslashes($option) }}')"
                                @if($answered) disabled @endif
                                class="p-4 rounded-lg border-2 transition-all duration-200 text-left font-semibold
                                    @if($answered && $option === $correctAnswer)
                                        bg-green-500 border-green-400 text-white
                                    @elseif($answered && $option === $selectedAnswer && $option !== $correctAnswer)
                                        bg-red-500 border-red-400 text-white
                                    @elseif($answered)
                                        bg-gray-700 border-gray-600 text-gray-400 opacity-50
                                    @else
                                        bg-gray-800 border-gray-600 text-white hover:bg-gray-700 hover:border-blue-400 cursor-pointer
                                    @endif
                                    @if($answered) cursor-not-allowed @endif"
                            >
                                {{ $option }}
                            </button>
                        @endforeach
                    </div>

                    @if($feedback)
                        <div class="mb-6 p-4 rounded-lg @if($feedback === 'correct') bg-green-900 border border-green-500 @else bg-red-900 border border-red-500 @endif">
                            <p class="text-white font-semibold">
                                @if($feedback === 'correct')
                                    Correct! 🎉
                                @else
                                    Incorrect. The correct answer was: {{ $correctAnswer }}
                                @endif
                            </p>
                        </div>
                    @endif

                    @if($answered)
                        <div class="text-center">
                            <button
                                wire:click="nextQuestion"
                                class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-colors duration-200"
                            >
                                @if($questionNumber < $totalQuestions)
                                    Next Question →
                                @else
                                    See Results →
                                @endif
                            </button>
                        </div>
                    @endif
                </div>
            @endif
        @else
            <div class="text-center">
                <h1 class="text-5xl font-bold text-white mb-4">Game Over!</h1>
                <div class="mb-8">
                    <div class="text-7xl font-bold text-green-400 mb-2">{{ $score }}</div>
                    <div class="text-xl text-gray-400">out of {{ $totalQuestions * 10 }} points</div>
                </div>

                <div class="mb-8 p-6 bg-gray-800 rounded-lg inline-block">
                    <div class="text-lg text-gray-300">
                        You got <span class="font-bold text-white">{{ $score / 10 }}</span> out of
                        <span class="font-bold text-white">{{ $totalQuestions }}</span> correct
                    </div>
                    <div class="text-sm text-gray-400 mt-2">
                        Accuracy: {{ round(($score / ($totalQuestions * 10)) * 100) }}%
                    </div>
                </div>

                <div class="flex gap-4 justify-center">
                    <button
                        wire:click="startNewGame"
                        class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-colors duration-200"
                    >
                        Play Again
                    </button>
                    <a
                        href="{{ route('dashboard') }}"
                        class="px-8 py-3 bg-gray-700 hover:bg-gray-600 text-white font-bold rounded-lg transition-colors duration-200"
                    >
                        Home
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>