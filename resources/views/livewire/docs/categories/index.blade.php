<div class="space-y-6">

    {{-- Search --}}
    <div class="flex justify-between items-center">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Cari kategori..."
            class="input input-bordered w-full max-w-xs bg-white text-black" />
    </div>

    {{-- Form --}}
    @if ($isEditing)
        <form wire:submit.prevent="update" class="space-y-3">
            <div>
                <label class="font-semibold">Edit Kategori</label>
                <input type="text" wire:model.defer="name" class="input input-bordered w-full bg-white text-black" />
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" wire:click="cancelEdit" class="btn btn-ghost">Batal</button>
            </div>
        </form>
    @else
        <form wire:submit.prevent="create" class="space-y-3">
            <div>
                <label class="font-semibold">Nama Kategori</label>
                <input type="text" wire:model.defer="name" class="input input-bordered w-full bg-white text-black"
                    placeholder="Contoh: Backend" />
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah Kategori</button>
        </form>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="table w-full bg-white border border-gray-200 rounded text-black">
            <thead class="bg-gray-100 text-black">
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Nama Kategori</th>
                    <th class="px-4 py-2 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $index => $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border-b">{{ $category->name }}</td>
                        <td class="px-4 py-2 border-b">
                            <div class="flex gap-2">
                                <button wire:click="edit({{ $category->id }})"
                                    class="btn btn-sm btn-outline btn-warning">Edit</button>
                                <button wire:click="delete({{ $category->id }})"
                                    onclick="confirm('Yakin hapus kategori ini?') || event.stopImmediatePropagation()"
                                    class="btn btn-sm btn-outline btn-error">Hapus</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-500 py-4">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div>
        {{ $categories->links() }}
    </div>

</div>
