<div>
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-1 gap-6">
            <label class="block">
                <span class="text-gray-700">¿Qué hábito deseas trabajar?</span>
                <input type="text"
                    class="mt-1 block w-full lg:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Nombre del hábito" wire:model="name">
                <div>
                    @error('name')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </label>
            <label class="block">
                <span class="text-gray-700">¿Cual es tu meta?</span>
                <input type="text"
                    class="mt-1 block w-full lg:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Detalla tu objetivo" wire:model="description">
                <div>
                    @error('description')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </label>
            <label class="block">
                <span class="text-gray-700 block">Fecha de finalización</span>
                <small class="text-gray-700 text-xs">Recomendamos que la fecha de finalización sea máximo un
                    mes.</small>
                <input type="date"
                    class="mt-1 block w-full lg:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    wire:model="due_date" min="{{ now()->format('Y-m-d') }}"
                    max="{{ now()->addDays(60)->format('Y-m-d') }}">
                <div>
                    @error('due_date')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </label>
            <label class="block">
                <span class="text-gray-700 block">¿Tienes algún supervisor?</span>
                <small class="text-gray-700 text-xs">Un supervisor puede ayudarte a cumplir con tu meta.</small>
                <input type="email"
                    class="mt-1 block w-full lg:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Correo del supervisor" wire:model="supervisor">
            </label>
        </div>
        <button type="submit" class="mt-5">Crear tarea</button>
    </form>
</div>
