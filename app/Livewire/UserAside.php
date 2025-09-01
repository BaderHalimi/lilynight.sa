<?php

namespace App\Livewire;

use Livewire\Component;

class UserAside extends Component
{
    public function redirectTo($url)
    {
        return redirect()->away($url);
    }

    public function render()
    {
        return view('livewire.user-aside');
    }
}
