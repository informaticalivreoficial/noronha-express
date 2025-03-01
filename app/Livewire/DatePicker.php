<?php

namespace App\Livewire;

use Livewire\Component;

class DatePicker extends Component
{
    public $dataSelecionada;

    public function updatedDataSelecionada($value)
    {
        $this->dispatch('atualizar-data', $value);
    }
    
    public function render()
    {
        return view('livewire.date-picker');
    }
}
