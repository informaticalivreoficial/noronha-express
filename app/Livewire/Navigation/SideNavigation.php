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
        $timeCount = User::where(function($query) {
            $query->where('editor', 1)
                ->orWhere('admin', 1)
                ->orWhere('superadmin', 1);
        })->count();
        $companyCount = Company::count();
        $tripCount = Trip::count();
        // Manifest count
        $manifestCount = Manifest::where(function($query) {
            $query->where('section', 'conferencia')
                ->orWhereNull('section');
        })->count();
        $manifestComercialCount = Manifest::where('section', 'comercial')->count();
        $manifestFinanceCount = Manifest::where('section', 'financeiro')->count();
        $manifestFinishCount = Manifest::where([
            ['status', '=', 'entregue'],
            ['section', '=', 'finalizado'],
        ])->count();
        $config = Config::first();

        return view('livewire.navigation.side-navigation',[
            'clientCount' => $clientCount,
            'timeCount' => $timeCount,            
            'companyCount' => $companyCount,
            'tripCount' => $tripCount,
            'manifestCount' => $manifestCount,
            'manifestComercialCount' => $manifestComercialCount,
            'manifestFinanceCount' => $manifestFinanceCount,
            'manifestFinishCount' => $manifestFinishCount,
            'config' => $config,
        ]);
    }
}
