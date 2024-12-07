<?php

namespace App\Livewire\Navigation;

use App\Models\User;
use Livewire\Component;

class SideNavigation extends Component
{
    public function render()
    {
        $userCount = User::where('client', 1)->count();
        return view('livewire.navigation.side-navigation',[
            'userCount' => $userCount
        ]);
    }
}
