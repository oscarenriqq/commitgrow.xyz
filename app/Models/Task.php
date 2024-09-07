<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'description',
        'due_date',
        'completed',
        'task_id',
        'user_id'
    ];

    public function getTotalDays() {
        $createdAt = Carbon::parse($this->created_at);
        $dueDate = Carbon::parse($this->due_date)->addDay(); // Asegúrate de que due_date exista en la base de datos

        return $createdAt->diffInDays($dueDate, false); 
    }

    public function getDaysFromStart() {
        $now = Carbon::now();
        $createdAt = Carbon::parse($this->created_at);

        return $createdAt->diffInDays($now);
    }

    public function getPercentageCompleted($completedDays) {
        if ($this->getDaysFromStart() == 0 && $completedDays == 1){
            return 100;
        }

        $percentage = ($completedDays / $this->getDaysFromStart()) * 100;

        return round($percentage, 0);
    
    }
}
