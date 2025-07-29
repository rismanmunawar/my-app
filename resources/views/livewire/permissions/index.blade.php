<div class="p-4 bg-white text-black rounded-lg shadow">
    {{-- Header + Search --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
        <h2 class="text-xl font-bold">Daftar Permission</h2>
        <div class="flex gap-2 items-center w-full md:w-auto">
            <input wire:model.debounce.500ms="search" type="text" placeholder="Cari permission..."
                class="input input-bordered input-sm w-full md:w-64 border-gray-300 rounded bg-white text-black" />
            @can('add.permissions')
                <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Permission
                </a>
            @endcan
        </div>
    </div>

    {{-- Success Alert --}}
    @if (session()->has('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="table text-black bg-white border border-gray-200 w-full">
            <thead class="bg-gray-100 text-black">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Dibuat</th>
                    @can('delete.permissions')
                        <th class="px-4 py-2">Aksi</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $i => $permission)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-2">{{ $permissions->firstItem() + $i }}</td>
                        <td class="px-4 py-2">{{ $permission->name }}</td>
                        <td class="px-4 py-2">{{ $permission->created_at->format('d M Y') }}</td>
                        @can('delete.permissions')
                            <td class="px-4 py-2">
                                <div class="flex gap-2">
                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                        class="btn btn-xs btn-warning">Edit</a>
                                    <button wire:click="delete({{ $permission->id }})"
                                        class="btn btn-xs btn-outline btn-error">Hapus</button>
                                </div>
                            </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">Tidak ada permission ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $permissions->links() }}
        </div>
    </div>
</div>
