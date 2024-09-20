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
                <div class="pb-10 flex flex-col gap-2 items-center">
                    <p class="text-center font-bold text-2xl">
                        ¡El reto ha terminado!
                    </p>
                    <p class="text-center">
                        Si tienes en mente otro reto, puedes llevarlo a cabo con CommitGrow.
                    </p>
                    <div class="bg-red-200 rounded-lg py-4 px-2 lg:px-4 text-sm text-center lg:w-1/2 mx-auto">
                        <p>En estos momentos no es posible tener más de 1 tarea activa a la vez. Elimina la tarea actual
                            y
                            crea otra nueva.</p>
                    </div>
                    <a class="font-bold bg-red-600 py-2 px-4 inline-block rounded-lg text-white text-sm mt-2"
                        href="/delete-task" wire:navigate>
                        Eliminar tarea
                    </a>
                </div>
            @endif
            <p>
                Hábito: {{ $task->name }}
            </p>
            <p>
                Meta a lograr: {{ $task->description }}
            </p>
            <p x-data="{
                link: '{{ route('status', ['id' => $task->uuid]) }}',
                copied: false,
                copy() {
                    $clipboard(this.link);
                    this.copied = true;
            
                    setTimeout(() => {
                        this.copied = false;
                    }, 2000);
                }
            }">
                Enlace de la tarea: <a class="underline font-bold" href="{{ route('status', ['id' => $task->uuid]) }}"
                    target="_blank">Visitar</a>
                <span class="font-bold block cursor-pointer text-blue-500 hover:text-blue-700" x-on:click="copy"
                    x-text="copied ? `¡Copiado!` : `Copiar enlance`">Copiar
                    enlace</span>
            </p>
            <h3 class="font-bold mt-5 mb-2">Tu registro</h3>
            <livewire:habit-tracker />
        @endif
    @else
        <a class="text-sm md:w-1/3 lg:text-base" role="button"
            href="https://todoist.com/oauth/authorize?client_id={{ config('app.todoist_client_id') }}&scope=data:read_write&state=1234567890">
            Conectar con todoist
        </a>
    @endif
</div>
