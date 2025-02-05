<div class="py-8 px-4 flex-col bg-gray-50 flex items-center justify-center">
    <div class="w-full max-w-lg">
        <h1 class="font-bold text-lg">Registro</h1>
        <p class="mb-4">Gracias por asistir a nuestra congregacion</p>
        <form class="" wire:submit="create">
            {{ $this->form }}
            <x-filament::button class="mt-8 w-full" type="submit">Completar registro</x-filament::button>
        </form>
    </div>
    <x-filament-actions::modals/>
</div>
