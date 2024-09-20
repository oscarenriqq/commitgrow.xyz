<?php

namespace App\Livewire\Pages;

use App\Models\Streak;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $task;

    public function render()
    {
        $this->task = Task::where('user_id', auth()->user()->id)->first();
        return view('livewire.pages.dashboard');
    }
}
