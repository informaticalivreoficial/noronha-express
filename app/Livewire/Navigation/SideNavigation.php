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
        $userCount = User::where('client', 1)->count();
        $companyCount = Company::count();
        $tripCount = Trip::count();
        $manifestCount = Manifest::count();
        $config = Config::first();

        return view('livewire.navigation.side-navigation',[
            'userCount' => $userCount,
            'companyCount' => $companyCount,
            'tripCount' => $tripCount,
            'manifestCount' => $manifestCount,
            'config' => $config,
        ]);
    }
}
