<div class="p-4 bg-white shadow rounded">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Topik</h2>
        <button wire:click="$parent.showCreate()" class="btn btn-primary">+ Tambah Topik</button>
    </div>

    <input wire:model.debounce.500ms="search" type="text" placeholder="Cari topik..." class="input input-bordered w-full mb-4" />

    <table class="table w-full">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Subkategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($topics as $topic)
                <tr>
                    <td>{{ $topic->title }}</td>
                    <td>{{ $topic->category->name ?? '-' }}</td>
                    <td>{{ $topic->subcategory->name ?? '-' }}</td>
                    <td class="space-x-2">
                        <button wire:click="$dispatch('edit-topic', {{ $topic->id }})" class="btn btn-sm btn-warning">Edit</button>
                        <button wire:click="confirmDelete({{ $topic->id }})" class="btn btn-sm btn-error">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $topics->links() }}
    </div>
</div>
