<?php

namespace App\Livewire;

use Auth;
use Livewire\Component;

class Navbar extends Component
{

    public function render()
    {
        $username = Auth::user()->name;
        return view('livewire.navbar', ['username' => $username]);
    }
}
