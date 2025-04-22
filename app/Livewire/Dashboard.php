<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.base')]
class Dashboard extends Component
{
    public function logout(){
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
