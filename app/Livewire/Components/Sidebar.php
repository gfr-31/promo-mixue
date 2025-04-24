<?php

namespace App\Livewire\Components;

use App\Helpers\FirebaseAuthHelper;
use Livewire\Component;

class Sidebar extends Component
{
    public $user;

    public function mount()
    {
        // $this->user = FirebaseAuthHelper::user();
        $this->user = FirebaseAuthHelper::user();
    }
    public function render()
    {
        return view('livewire.components.sidebar')->layout('layouts.dashboard');
    }
}
