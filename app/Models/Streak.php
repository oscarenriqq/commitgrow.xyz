<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Streak extends Model
{
    use HasFactory;

    protected $table = 'streaks';

    protected $fillable = [
        'user_id',
        'task_id',
        'day',
        'completed',
    ];
}
