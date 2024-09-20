<?php

namespace App\Livewire\Pages;

use App\Models\Task;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Status extends Component
{
    public $uuid;
    public $full_name;
    public $task;

    public function mount($id) {
        $this->uuid = $id;
    }

    public function render()
    {
        $this->task = Task::where('uuid', $this->uuid)->first();
        $this->full_name = $this->task->user->name;

        return view('livewire.pages.status');
    }
}
