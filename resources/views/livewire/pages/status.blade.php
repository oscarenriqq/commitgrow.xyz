@section('hideNavigation', true)

<div class="flex flex-col">
    <h2 class="text-xl font-bold">Status de {{ $full_name }}</h2>
    <p class="mb-5 text-xs md:text-base">Aquí podrás ver el progreso de {{ $full_name }} y ver si está cumpliendo el
        objetivo.</p>
    <livewire:habit-tracker :uuid="$uuid" />
</div>
