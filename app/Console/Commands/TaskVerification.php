<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TaskVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task-verification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para actualizar las tareas que hayan finalizado y no estén completas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info('Cron job running at '. Carbon::today());

        $today = Carbon::today()->toDateString();
        Task::where(column: 'completed', operator: 0)
            ->where(column: 'due_date',operator: $today)
            ->update(['completed' => 1]);
    }
}
