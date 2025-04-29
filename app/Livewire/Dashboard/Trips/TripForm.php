<?php

namespace App\Livewire\Dashboard\Trips;

use App\Models\Trip;
use Carbon\Carbon;
use Livewire\Component;

class TripForm extends Component
{
    public ?Trip $trip = null;

    public string $start = '';
    public ?string $stop = null;
    public string $ship = '';
    public string $information = '';

    public function mount()
    {
        if ($this->trip) {
            $this->start = optional($this->trip->start)->format('Y-m-d');
            $this->stop = optional($this->trip->stop)->format('Y-m-d');
            $this->ship = $this->trip->ship;
            $this->information = $this->trip->information;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'start' => 'required|date_format:d/m/Y',
            //'stop' => 'nullable|date|after_or_equal:start',
            //'ship' => 'required|string|max:255',
            //'information' => 'nullable|string',
        ]);

        $data = [
            'start' => $this->start,
            //'stop' => $this->stop ? Carbon::parse($this->stop) : null,
            //'ship' => $this->ship,
            //'information' => $this->information,
        ];
dd($data);
        if ($this->trip) {
            $this->trip->update($data);
            session()->flash('message', 'Viagem atualizada com sucesso!');
        } else {
            Trip::create($data);
            session()->flash('message', 'Viagem criada com sucesso!');
            $this->reset(['start', 'stop', 'ship', 'information']);
        }
    }

    public function render()
    {
        $title = $this->trip ? 'Editar Viagem' : 'Cadastrar Viagem';
        return view('livewire.dashboard.trips.trip-form')->with('title', $title);
    }
}
