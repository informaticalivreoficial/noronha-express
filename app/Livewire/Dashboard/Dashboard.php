<?php

namespace App\Livewire\Dashboard;

use App\Models\Trip;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $tripCount = Trip::count();
        $tripYearCount = Trip::whereYear('start', now()->year)->count();

        return view('livewire.dashboard.dashboard',[
            'tripCount' => $tripCount,
            'tripYearCount' => $tripYearCount,
        ]);
    }
}
