<?php

namespace App\Livewire\Navigation;

use App\Models\Company;
use App\Models\Config;
use App\Models\Manifest;
use App\Models\Trip;
use App\Models\User;
use Livewire\Component;

class SideNavigation extends Component
{
    public function render()
    {
        $clientCount = User::where('client', 1)->count();
        $timeCount = User::where('editor', 1)->orWhere('admin', 1)->orWhere('superadmin', 1)->count();
        $companyCount = Company::count();
        $tripCount = Trip::count();
        // Manifest count
        $manifestCount = Manifest::count();
        $manifestFinishCount = Manifest::where('status', 'entregue')->count();
        $config = Config::first();

        return view('livewire.navigation.side-navigation',[
            'clientCount' => $clientCount,
            'timeCount' => $timeCount,            
            'companyCount' => $companyCount,
            'tripCount' => $tripCount,
            'manifestCount' => $manifestCount,
            'manifestFinishCount' => $manifestFinishCount,
            'config' => $config,
        ]);
    }
}
