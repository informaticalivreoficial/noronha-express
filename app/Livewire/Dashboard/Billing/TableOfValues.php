<?php

namespace App\Livewire\Dashboard\Billing;

use Livewire\Component;

class TableOfValues extends Component
{
    public $id = 1;

    public float $dry_weight = 0.0;
    public float $horti_fruit = 0.0;
    public float $glace = 0.0;
    public float $general_1000_5000 = 0.0;
    public float $general_above_5000 = 0.0;
    public float $cubage = 0.0;

    public function render()
    {
        $title = 'Tabela de valores para frete';
        return view('livewire.dashboard.billing.table-of-values')->with('title', $title);
    }

    public function mount()
    {
        
    }

    public function update()
    {
        $this->validate([
            'dry_weight' => 'required|numeric|min:0',
            'horti_fruit' => 'required|numeric|min:0',
            'glace' => 'required|numeric|min:0',
            'general_1000_5000' => 'required|numeric|min:0',
            'general_above_5000' => 'required|numeric|min:0',
            'cubage' => 'required|numeric|min:0',
        ]);

        // Exemplo: atualizando um registro existente (ID 1)
        $frete = FreteTabela::findOrFail($this->id);

        $frete->update([
            'dry_weight' => $this->dry_weight,
            'horti_fruit' => $this->horti_fruit,
            'glace' => $this->glace,
            'general_1000_5000' => $this->general_1000_5000,
            'general_above_5000' => $this->general_above_5000,
            'cubage' => $this->cubage,
        ]);

        session()->flash('success', 'Tabela de valores atualizada com sucesso!');
    }
}
