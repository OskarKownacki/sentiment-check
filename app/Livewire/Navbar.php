<?php

namespace App\Livewire;

use Auth;
use Livewire\Component;

class Navbar extends Component
{

    public function render()
    {
        if (isset(Auth::user()->name)) {
            $username = Auth::user()->name;
            return view('livewire.navbar', ['username' => $username]);
        }
        else{
            return view('livewire.navbar');
        }
        
    }
}
