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
                <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                <td class="px-4 py-2 border-b">{{ $category->name }}</td>
                <td class="px-4 py-2 border-b">
                    <div class="flex gap-2">
                        <button wire:click="edit({{ $category->id }})"
                            class="btn btn-sm btn-outline btn-warning">Edit</button>
                        <button wire:click="delete({{ $category->id }})" class="btn btn-sm btn-outline btn-error"
                            onclick="confirm('Yakin hapus kategori ini?') || event.stopImmediatePropagation()">Hapus</button>
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
