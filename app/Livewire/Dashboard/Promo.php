<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Promo extends Component
{
    public function render()
    {
        $promos = [];

        return view('livewire.dashboard.promo', compact('promos'))->layout('layouts.dashboard');
    }
}
