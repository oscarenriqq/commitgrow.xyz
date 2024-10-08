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
        'user_id',
        'supervisor',
        'uuid'
    ];

    protected $hidden = [
        'uuid'
    ];

    public function getTotalDays() {
        $createdAt = Carbon::parse($this->created_at);
        $dueDate = Carbon::parse($this->due_date)->addDay(); // Asegúrate de que due_date exista en la base de datos

        return $createdAt->diffInDays($dueDate, false); 
    }

    public function getDaysFromStart() {
        $now = Carbon::now();
        $createdAt = Carbon::parse($this->created_at)->subDay();

        return $createdAt->diffInDays($now);
    }

    public function getPercentageCompleted($completedDays) {
        if ($this->getDaysFromStart() == 0 && $completedDays == 1){
            return 100;
        } else if($this->getDaysFromStart() == 0 && $completedDays == 0) {
            return 0;
        }

        $percentage = ($completedDays / $this->getDaysFromStart()) * 100;

        return round($percentage, 0);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
