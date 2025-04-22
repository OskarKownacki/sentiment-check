<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('components.layouts.base')]

class Login extends Component
{
    #[Validate('required|string')]
    public $password ='';
    #[Validate('required|string|email')]
    public $email = '';
    public function login(){
        Auth::logout();
        $this->validate();
        if(Auth::attempt(['email'=> $this->email,'password'=> $this->password])){
            session()->regenerate();
            
            return redirect()->route('home');
        }

    }
    public function render()
    {
        return view('livewire.login');
    }
}
