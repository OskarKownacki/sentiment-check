<?php

namespace App\Livewire;

use App\Models\User;
use Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
#[Layout('components.layouts.base')]
class Register extends Component
{
    #[Validate('required|email|string', message: 'Please enter a valid email address.')]
    public $email = '';
    #[Validate('required|string|min:8|confirmed')]
    public $password = '';
    #[Validate('required|string|min:3|max:20')]
    public $username = '';
    public $password_confirmation = '';

    public function register()
    {
        $this->validate();

        $user = User::create([
            'email' => $this->email,
            'password' => $this->password,
            'name' => $this->username,

        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
    public function render()
    {
        return view('livewire.register');
    }
}
