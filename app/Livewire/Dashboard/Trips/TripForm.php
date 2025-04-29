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

    public function mount(?Trip $trip = null)
    {
        if ($trip) {
            $this->trip = $trip;
            $this->start = optional($trip->start)->format('Y-m-d\TH:i');
            $this->stop = optional($trip->stop)->format('Y-m-d\TH:i');
            $this->ship = $trip->ship;
            $this->information = $trip->information;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'start' => 'required|date',
            'stop' => 'nullable|date|after_or_equal:start',
            'ship' => 'required|string|max:255',
            'information' => 'nullable|string',
        ]);

        $data = [
            'start' => Carbon::parse($this->start),
            'stop' => $this->stop ? Carbon::parse($this->stop) : null,
            'ship' => $this->ship,
            'information' => $this->information,
        ];

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
        return view('livewire.dashboard.trips.trip-form');
    }
}
