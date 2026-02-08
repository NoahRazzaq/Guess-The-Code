<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Livewire Counter</h1>
        
        <div class="text-center mb-6">
            <span class="text-6xl font-bold text-blue-600">{{ $count }}</span>
        </div>

        <div class="flex gap-4 justify-center">
            <button 
                wire:click="decrement" 
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transition duration-200"
            >
                - Decrement
            </button>
            
            <button 
                wire:click="increment" 
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-200"
            >
                + Increment
            </button>
        </div>
    </div>
</div>