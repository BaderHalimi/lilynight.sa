<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Services;

class ServicesShow extends Component
{
    public $services;
    public function mount()
    {
        $services = Services::all();
    }
    public function render()
    {
        return view('livewire.services-show');
    }
}
