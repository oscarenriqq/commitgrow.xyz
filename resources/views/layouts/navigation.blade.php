<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a class="font-bold lg:text-2xl"
                        href="{{ Route::has('dashboard') ? route('dashboard') : route('welcome') }}" wire:navigate>
                        {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> --}}
                        CommitGrow
                    </a>
                </div>
            </div>
            <div class="flex items-center text-xs lg:text-lg text-gray-600 gap-2">
                @if (Auth::check())
                    <a class="hover:underline cursor-pointer" href="{{ route('profile.edit') }}" wire:navigate>
                        Perfil
                    </a>
                    <a class="hover:underline cursor-pointer"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a class="hover:underline cursor-pointer" href="{{ route('login') }}" wire:navigate>Iniciar
                        sesión</a>
                @endif
            </div>
        </div>
    </div>

</nav>
