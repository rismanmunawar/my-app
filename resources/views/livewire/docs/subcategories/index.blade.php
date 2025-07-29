<div class="space-y-4">
    {{-- Form --}}
    @if ($isEditing)
        <form wire:submit.prevent="update" class="space-y-3">
            <div>
                <label class="font-semibold">Edit Subkategori</label>
                <input type="text" wire:model.defer="name"
                    class="input w-full bg-white text-black border border-gray-300" />
                <select wire:model.defer="category_id"
                    class="select w-full mt-2 bg-white text-black border border-gray-300">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                @error('category_id')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
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
                <label class="font-semibold">Nama Subkategori</label>
                <input type="text" wire:model.defer="name"
                    class="input w-full bg-white text-black border border-gray-300" placeholder="Contoh: API" />
                <select wire:model.defer="category_id"
                    class="select w-full mt-2 bg-white text-black border border-gray-300">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                @error('category_id')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah Subkategori</button>
        </form>
    @endif


    {{-- Search --}}
    <div>
        <input type="text" wire:model.debounce.500ms="search" placeholder="Cari subkategori..."
            class="input input-bordered w-full bg-white text-black border-gray-300" />
    </div>

    {{-- Table --}}
    <table class="table w-full bg-white border border-gray-200 rounded text-black">
        <thead class="bg-gray-100 text-black">
            <tr>
                <th class="px-4 py-2 border-b">#</th>
                <th class="px-4 py-2 border-b">Nama</th>
                <th class="px-4 py-2 border-b">Kategori</th>
                <th class="px-4 py-2 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subcategories as $index => $subcategory)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b">{{ $subcategory->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $subcategory->category->name ?? '-' }}</td>
                    <td class="px-4 py-2 border-b">
                        <div class="flex gap-2">
                            <button wire:click="edit({{ $subcategory->id }})"
                                class="btn btn-sm btn-warning">Edit</button>
                            <button wire:click="delete({{ $subcategory->id }})" class="btn btn-sm btn-error"
                                onclick="confirm('Yakin hapus subkategori?') || event.stopImmediatePropagation()">Hapus</button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-4">Belum ada subkategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $subcategories->links() }}
</div>
