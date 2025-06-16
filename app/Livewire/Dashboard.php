<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\News;

#[Layout('components.layouts.base')]
class Dashboard extends Component
{

    public $articles;
    public $selectedArticle;
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

    public function mount()
    {

        $this->articles = News::where('user_id', "=", Auth::id())->get()->toArray();
    }

    public function openFullscreen($index)
    {
        $this->selectedArticle = $this->articles[$index];
        $this->fullscreen = true;
    } 

    public function closeFullscreen()
    {
        $this->selectedArticle = null;
        $this->fullscreen = false;
    }
}
