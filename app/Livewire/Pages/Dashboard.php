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
    public $now;
    public $task;
    public $totalDays = 0;
    public $completedDays = 0;
    public $maxStreak = 0;
    public $streaks= [];
    public $biggestStreak = 0;
    public $percentageCompleted = 0;

    public function mount() {
        $this->now = Carbon::now();
    }

    public function getBgColor($day, $completed) {
        $bgColor = 'bg-gray-400';

        $day = Carbon::parse($day);

        if ($this->now->isSameDay($day)) {
            $bgColor = $completed ? 'bg-green-500' : 'bg-gray-200';
        } elseif ($this->now->greaterThan($day)) {
            $bgColor = $completed ? 'bg-green-500' : 'bg-red-500';
        } elseif ($this->now->lessThan($day)) {
            $bgColor = $completed ? 'bg-green-500' : 'bg-gray-200';
        }

        return $bgColor;
    }

    public function calculateStreaks() {
        foreach($this->streaks as $streak) {
            if ($streak->completed) {
                $this->biggestStreak ++;
            }
            else {
                if ($this->biggestStreak > 0) {
                    $this->addMaxStreak($this->biggestStreak);
                    $this->biggestStreak = 0;
                }
            }
        }
    }

    public function addMaxStreak($streak) {
        $this->maxStreak = $streak > $this->maxStreak ? $streak : $this->maxStreak;
    } 

    public function render()
    {
        // Establecer el idioma a español
        Carbon::setLocale('es');

        if (auth()->user()->todoist_access_token) {
            $this->task = Task::where('user_id', auth()->user()->id)->first();

            if (isset($this->task)) {
                $this->totalDays = $this->task->getTotalDays();
                $this->streaks = Streak::where('user_id', auth()->user()->id)
                                        ->where('task_id', $this->task->task_id)
                                        ->get();
            }

            if ($this->streaks) {
                $completedDays = $this->streaks->filter(function($streak) {
                    return $streak->completed;
                })->count();
                $this->percentageCompleted = $this->task->getPercentageCompleted($completedDays);
                $this->calculateStreaks();
            }
            else {
                $completedDays = 0;
            }

        }

        return view('livewire.pages.dashboard');
    }
}
