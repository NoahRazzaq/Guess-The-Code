<x-app-layout>
    <div class="min-h-screen bg-gray-900 flex items-center justify-center px-4">
        <div class="max-w-2xl w-full text-center">
            <div class="mb-12">
                <h1 class="text-6xl md:text-7xl font-bold text-white mb-4">
                    Guess the <span class="text-blue-500">Code</span>
                </h1>
                <p class="text-xl text-gray-400">
                    Test your knowledge of programming languages and frameworks
                </p>
            </div>

            <div class="bg-gray-800 rounded-lg p-6 mb-12 border border-gray-700 text-left">
                <pre class="text-sm font-mono text-gray-300"><code>function guessTheCode() {
  const skills = ['React', 'Vue', 'Laravel', 'Django'];
  return skills.map(skill => 
    canYouGuess(skill) ? '✅' : '❌'
  );
}</code></pre>
            </div>

            <div class="space-y-6">
                <a 
                    href="{{ route('quiz') }}"
                    class="inline-block px-12 py-4 bg-blue-600 hover:bg-blue-700 text-white text-xl font-bold rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg"
                >
                    Start Playing
                </a>

                @auth
                    <div class="text-gray-400">
                        Welcome back, <span class="text-white font-semibold">{{ auth()->user()->name }}</span>!
                    </div>
                @endauth
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                <div class="p-6 bg-gray-800 rounded-lg border border-gray-700">
                    <div class="text-3xl mb-3">🎯</div>
                    <h3 class="text-lg font-bold text-white mb-2">10 Questions</h3>
                    <p class="text-gray-400 text-sm">Quick quiz to test your framework recognition skills</p>
                </div>
                <div class="p-6 bg-gray-800 rounded-lg border border-gray-700">
                    <div class="text-3xl mb-3">⚡</div>
                    <h3 class="text-lg font-bold text-white mb-2">20+ Frameworks</h3>
                    <p class="text-gray-400 text-sm">From React to Laravel, Django to Spring Boot</p>
                </div>
                <div class="p-6 bg-gray-800 rounded-lg border border-gray-700">
                    <div class="text-3xl mb-3">🏆</div>
                    <h3 class="text-lg font-bold text-white mb-2">Track Progress</h3>
                    <p class="text-gray-400 text-sm">See your score and improve over time</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>