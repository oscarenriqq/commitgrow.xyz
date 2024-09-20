<div>

    <div class="grid grid-cols-5 md:grid-cols-7 lg:grid-cols-7 gap-2">
        @if ($totalDays > 0)
            @foreach ($streaks as $streak)
                <div class="flex flex-col items-center">
                    <span class="w-8 h-8 {{ $this->getBgColor($streak->day, $streak->completed) }} rounded-full">
                    </span>
                    <p class="text-center text-xs">{{ $streak->day_formatted }}</p>
                </div>
            @endforeach
        @endif
    </div>
    <div class="mt-5">
        @if (Route::currentRouteName() != 'status')
            <h3 class="font-bold">Estadísticas</h3>
            @if ($maxStreak > 0)
                @if ($maxStreak == $streaks->count())
                    <p>¡Tu racha está intacta! </p>
                @elseif($maxStreak == 1)
                    <p>Tu racha es de 1 día.</p>
                @else
                    <p class="text-sm">Tu mayor racha es de {{ $maxStreak }} días.</p>
                @endif
            @endif
        @endif
        {{-- <p class="text-sm"> Tienes un {{ $percentageCompleted }}% de cumplimiento.</p> --}}
        @if (!$task->completed && Route::currentRouteName() != 'status')
            <div class="text-right">
                <a class="font-bold bg-red-600 py-2 px-4 inline-block rounded-lg text-white text-sm mt-5"
                    href="/delete-task" wire:navigate>
                    Eliminar tarea
                </a>
            </div>
        @endif
    </div>
</div>
