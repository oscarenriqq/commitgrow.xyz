<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <p>¡Estás seguro que quieres eliminar la tarea <span class="font-bold">{{ $task->name }}</span>?</p>
    <div class="mt-5">
        <a class="font-bold bg-gray-600 py-2 px-4 inline-block rounded-lg text-white text-sm" href="/dashboard"
            wire:navigate>
            Cancelar
        </a>
        <a class="font-bold bg-red-600 py-2 px-4 inline-block rounded-lg text-white text-sm" wire:click="deleteTask"
            wire:loading.attr="disabled">
            Eliminar tarea
        </a>
    </div>
</div>
