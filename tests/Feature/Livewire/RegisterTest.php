<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Register;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_renders_successfully()
    {
        Livewire::test(Register::class)
            ->assertStatus(200);
    }

    public function test_it_validates(){
        Livewire::test(Register::class)
        ->set('email','notAnEmail')
        ->set('password','pass')
        ->set('username','aVeryLongNameThatsWellAbove20Characters')
        ->call('register')
        ->assertHasErrors('email')
        ->assertHasErrors('password')
        ->assertHasErrors('username');
    }
}
