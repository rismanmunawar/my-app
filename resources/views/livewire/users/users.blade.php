<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Manajemen User</h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
        {{-- Form tambah/edit user --}}
        <div>
            <livewire:users.form />
        </div>

        {{-- Tabel user --}}
        <div>
            <livewire:users.index />
        </div>
    </div>
</x-app-layout>
