{{-- <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot> --}}
@php
    $biggestStreak = 0;
    $biggestStreakArr = [];
@endphp

<div>
    @if (session()->has('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
            class="bg-red-100 border-l-4 border-red-500 text-red-500 p-4 my-4">
            {{ session('error') }}
        </div>
    @endif
    @if (auth()->user()->todoist_access_token)
        @if (is_null($task))
            <div class="flex flex-col items-start gap-2">
                <p>Aún no has creado ninguna tarea.</p>
                <a role="button" href="/create-task" wire:navigate>Crear tarea</a>
            </div>
        @else
            <p>
                Hábito: {{ $task->name }}
            </p>
            <p>
                Meta a lograr: {{ $task->description }}
            </p>
            <h3 class="font-bold mt-5 mb-2">Tu registro</h3>
            <div class="grid grid-cols-5 md:grid-cols-7 lg:grid-cols-7 gap-2">
                @if ($totalDays > 0)
                    @foreach ($streaks as $streak)
                        <div class="flex flex-col items-center">
                            <span
                                class="w-8 h-8 {{ $this->getBgColor($streak->day, $streak->completed) }} rounded-full"></span>
                            <p class="text-center text-xs">{{ $streak->day_formatted }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="mt-5">
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
                <p class="text-sm"> Tienes un {{ $percentageCompleted }}% de cumplimiento.</p>
            </div>
        @endif
    @else
        <a href="https://todoist.com/oauth/authorize?client_id={{ config('app.todoist_client_id') }}&scope=data:read_write&state=1234567890"
            class="link" target="_blank">
            Conectar con todoist
        </a>
    @endif
</div>
