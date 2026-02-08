<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestCounter extends Component
{
    public int $count = 0;

    public function increment(): void
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.test-counter');
    }
}
