<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("layouts.home")]
class Welcome extends Component
{
    public function render()
    {
        return view('livewire.pages.welcome');
    }
}
