<?php

namespace App\Livewire\Dashboard\Trips;

use App\Http\Requests\Admin\StoreUpdateTripRequest;
use App\Models\Trip;
use Carbon\Carbon;
use Livewire\Component;

class TripForm extends Component
{
    public ?Trip $trip = null;

    public string $start = '';
    public ?string $stop = null;
    public ?string $ship = null;
    public ?string $information = null;

    public function mount()
    {
        if ($this->trip) {
            $this->start = $this->trip->start;
            $this->stop = $this->trip->stop;
            $this->ship = $this->trip->ship;
            $this->information = $this->trip->information;
        }
    }

    public function save()
    {
        $request = new StoreUpdateTripRequest();
        $request->merge([
            'start' => $this->start,
            'stop' => $this->stop,
            //'ship' => $this->ship,
            //'information' => $this->information,
        ]);
        $validated = validator($request->all(), $request->rules())->validate(); 

        $data = [
            'start' => $this->start,
            'stop' => $this->stop ? $this->stop : null,
            'ship' => $this->ship,
            'information' => $this->information,
        ];

        if ($this->trip) {
            $this->trip->update($data);
            $this->dispatch(['atualizado']);
        } else {

            $startDate = Carbon::createFromFormat('d/m/Y', $this->start)->startOfDay();

            $query = Trip::whereDate('start', $startDate)->where('ship', $this->ship);

            if ($this->trip) {
                $query->where('id', '!=', $this->trip->id);
            }

            if ($query->exists()) {
                $this->addError('start', 'Já existe uma viagem cadastrada para essa data e navio.');
                return;
            }

            $tripCreate = Trip::create($data);            
            $this->dispatch(['cadastrado']);
            $this->trip = $tripCreate;
        }
    }

    public function render()
    {
        $title = $this->trip ? 'Editar Viagem' : 'Cadastrar Viagem';
        return view('livewire.dashboard.trips.trip-form')->with('title', $title);
    }    
}
