<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Dashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_renders_successfully()
    {
        Livewire::test(Dashboard::class)
            ->assertStatus(200);
    }
}
