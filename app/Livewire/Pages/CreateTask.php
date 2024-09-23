<?php

namespace App\Livewire\Pages;

use App\Models\Streak;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class CreateTask extends Component
{
    #[Validate('required', message: 'El nombre de la tarea es obligatorio.')]
    public $name;
    #[Validate('required', message:'Descripción de la tarea es obligatoria.')]
    public $description;
    #[Validate('required', message:'Fecha de finalización es obligatoria.')]
    public $due_date;
    public $supervisor;

    public function save() {

        $this->validate();

        if (Task::where('user_id', auth()->user()->id)->count() == 0) {

            Carbon::setLocale('es');

            $uuid = Str::uuid()->toString();

            $todoistCreatedTask = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . auth()->user()->todoist_access_token
            ])
            ->post(config('app.todoist_api_url') . '/tasks', [
                'content' => $this->name,
                'description' => $this->description . "\n\n Sigue tu progreso en: https://www.commitgrow.xyz/status/". $uuid,
                'due_string' => 'every day starting today ending ' . $this->due_date 
            ])->json();

            $createdTask = Task::create([
                'name'=> $this->name,
                'description'=> $this->description,
                'due_date'=> $this->due_date,
                'completed'=> false,
                'task_id' => $todoistCreatedTask['id'],
                'user_id' => auth()->user()->id,
                'supervisor' => $this->supervisor ?? null,
                'uuid' => $uuid
            ]);

            //Agregar rachas
            $streaks = [];
            $totalDays = $createdTask->getTotalDays();

            $currentDate = Carbon::now()->startOfDay(); 
            
            for($i = 0; $i <= $totalDays; $i++) {
                $curDate = $i == 0 ? $currentDate : $currentDate->addDay();
                $streaks[] = [
                    'user_id' => auth()->user()->id, 
                    'task_id' => $todoistCreatedTask['id'], 
                    'day'     => $curDate->toDateString(),
                    'day_formatted' => str_replace('.', '', ucfirst($curDate->translatedFormat('M j')))
                ];
            } 

            Streak::insert($streaks);

            session()->flash('status', 'Tarea creada exitosamente.');

            return $this->redirectRoute('dashboard');
        }
        else {
            session()->flash('error', 'Ya tiene una tarea creada');

            $this->redirectRoute('dashboard', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.pages.create-task');
    }
}
