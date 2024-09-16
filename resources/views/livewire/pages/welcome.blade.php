<div class="flex flex-col items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl lg:text-7xl font-bold text-gray-900">CommitGrow</h1>
        <p class="text-sm lg:text-lg">Comprométete hoy, crece mañana</p>
    </div>

    <img src="{{ asset('images/home_img.svg') }}" alt="Imagen de la página principal" class="w-2/3 lg:w-1/3 mt-6 lg:mt-10">
    <a role="button" class="mt-12 mb-5 text-xl" href="/register" wire:navigate>
        Regístrate </a>
    <div class="mt-6 p-5 text-center flex flex-col items-center gap-5 lg:w-2/3">
        <p class="lg:text-2xl">CommitGrow es un rastreador de hábitos integrado con <a href="https://www.todoist.com"
                class="underline" target="_blank">Todoist</a>.</p>
        <img src="{{ asset('images/todoist.png') }}" alt="Logo de Todoist" class="w-1/2 lg:w-1/3 lg:my-10">
        <p class="mt-4 lg:text-2xl">Completa tus tareas en Todoist, y deja que CommitGrow te muestre tu crecimiento día
            a
            día.</p>
    </div>
</div>
