<?php

namespace App\Livewire\Buttons;

use Livewire\Component;

class Toogle extends Component
{
    public bool $status;
    public function render()
    {
        return view('livewire.buttons.toogle');
    }
}
