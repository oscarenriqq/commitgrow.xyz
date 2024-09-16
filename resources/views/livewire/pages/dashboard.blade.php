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
                <p>¿Ya tienes tu objetivo definido? ¡Crea una tarea!</p>
                <a role="button" href="/create-task" wire:navigate>Crear tarea</a>
            </div>
        @else
            @if ($task->completed)
                <div class="pb-10 flex flex-col gap-2">
                    <p class="text-center font-bold text-2xl">
                        ¡Tu reto de 21 días ha terminado!
                    </p>
                    <p class="">
                        Si tienes en mente otro reto, puedes llevarlo a cabo con CommitGrow.
                    </p>
                    <div class="bg-red-200 rounded py-2 px-4 text-sm">
                        <p>En estos momentos no es posible tener más de 1 tarea activa a la vez. Elimina la tarea actual
                            y
                            crea otra nueva.</p>
                        <a class="font-bold bg-red-600 py-2 px-4 inline-block rounded-lg text-white text-sm mt-2"
                            href="/delete-task" wire:navigate>
                            Eliminar tarea
                        </a>
                    </div>
                </div>
            @endif
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
                                class="w-8 h-8 {{ $this->getBgColor($streak->day, $streak->completed) }} rounded-full">
                            </span>
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
                @if (!$task->completed)
                    <div class="text-right">
                        <a class="font-bold bg-red-600 py-2 px-4 inline-block rounded-lg text-white text-sm mt-5"
                            href="/delete-task" wire:navigate>
                            Eliminar tarea
                        </a>
                    </div>
                @endif
            </div>
        @endif
    @else
        <a href="https://todoist.com/oauth/authorize?client_id={{ config('app.todoist_client_id') }}&scope=data:read_write&state=1234567890"
            class="link">
            Conectar con todoist
        </a>
    @endif
</div>
