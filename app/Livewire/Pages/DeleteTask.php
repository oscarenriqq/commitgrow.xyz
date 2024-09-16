<?php

namespace App\Livewire\Pages;

use App\Models\Streak;
use App\Models\Task;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("layouts.app")]
class DeleteTask extends Component
{
    public $task;
    public $userId;
    public function mount() {
        $this->userId = auth()->user()->id;

        $this->task = Task::where("user_id", $this->userId)->first();
    }

    public function deleteTask() {
        $this->task->delete();

        Streak::where("user_id", $this->userId)->delete();

        session()->flash('delete', 'Tarea eliminada exitosamente.');

        $this->redirect(route("dashboard"));
    }

    public function render()
    {
        return view('livewire.pages.delete-task');
    }
}
