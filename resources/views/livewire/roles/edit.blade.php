<div class="p-6 bg-white text-black rounded shadow max-w-4xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6 flex items-center gap-2 text-black">
        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-shield h-6 w-6 text-primary" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        {{ $isEdit ? 'Edit Role' : 'Tambah Role' }}
    </h2>

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">

                {{-- Nama Role --}}
                <div class="form-control w-full">
                    <label class="block text-sm font-medium mb-1 text-black">Nama Role</label>
                    <div class="relative">
                        <input type="text" wire:model.defer="name" placeholder="Misal: admin, staff"
                            class="input w-full border border-gray-300 rounded bg-white text-black pl-10" />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c0-1.657-1.343-3-3-3S6 9.343 6 11s1.343 3 3 3 3-1.343 3-3zm6 0a3 3 0 00-3-3 3 3 0 000 6 3 3 0 003-3zM3 20h18" />
                            </svg>
                        </div>
                    </div>
                    @error('name')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Permissions (jika ada) --}}
                @if ($showPermissions ?? false)
                    <div class="form-control w-full">
                        <label class="block text-sm font-medium mb-2 text-black">Permissions</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($allPermissions as $permission)
                                <label class="inline-flex items-center space-x-2">
                                    <input type="checkbox" wire:model.defer="selectedPermissions"
                                        value="{{ $permission }}" class="checkbox checkbox-primary" />
                                    <span>{{ $permission }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('selectedPermissions')
                            <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                @endif
            </div>

            {{-- Sidebar kanan --}}
            <div class="space-y-6">
                <div
                    class="border-dashed border-2 border-gray-200 rounded-lg min-h-[300px] flex items-center justify-center text-gray-400 text-sm">
                    Area kosong (bisa untuk deskripsi role, avatar, preview hak akses, dll)
                </div>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-2 pt-6">
            <a href="{{ route('roles.index') }}" class="btn btn-outline btn-neutral">Batal</a>
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
