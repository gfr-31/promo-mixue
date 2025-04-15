<?php

namespace App\Livewire;

use Kreait\Firebase\Contract\Database;
use Livewire\Component;

class Dashboard extends Component
{
    public $promo;
    public $periode;
    public $promos = [];
    public $showFull = [];

    public function submit(Database $database)
    {
        $this->validate([
            'promo' => 'required|string',
            'periode' => 'required|string',
        ]);

        $data = [
            'promo' => $this->promo,
            'periode' => $this->periode,
            'comments' => []
        ];

        $database->getReference('promos')->push($data);

        $this->reset(['promo', 'periode']);
        $this->refreshData();
    }
    public function refreshData(Database $database)
    {
        try {
            $data = $database->getReference('promos')->getValue() ?? [];

            $this->promos = is_array($data) ? array_values($data) : [];

            foreach ($this->promos as $key => $promo) {
                $this->showFull[$key] = false;
            }
        } catch (\Exception $e) {
            $this->promos = [];
            $this->showFull = [];

            \Log::error('Firebase gagal diakses: ' . $e->getMessage());
        }
    }
    public function mount(Database $database)
    {
        $this->refreshData($database);
    }

    public function togglePromo($key)
    {
        $this->showFull[$key] = !$this->showFull[$key];
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
