<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class TableOfValues extends Component
{
    public $id = 1;

    public function render()
    {
        $title = 'Tabela de valores para frete';
        return view('livewire.dashboard.table-of-values')->with('title', $title);
    }
}
