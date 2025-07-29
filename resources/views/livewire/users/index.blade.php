<div class="p-4 bg-white text-black rounded-lg shadow">
    {{-- Header + Search --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
        <h2 class="text-xl font-bold">Daftar User</h2>
        <div class="flex gap-2 items-center w-full md:w-auto">
            <input wire:model.debounce.500ms="search" type="text" placeholder="Cari nama/email..."
                class="input input-bordered input-sm w-full md:w-64 border-gray-300 rounded bg-white text-black" />
            @can('add.users')
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah User
                </a>
            @endcan
        </div>
    </div>

    {{-- Success Alert --}}
    @if (session()->has('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    {{-- Table --}}
    <div class="mt-4 overflow-x-auto">
        <table class="table text-black bg-white border border-gray-200 w-full">
            <thead class="bg-gray-100 text-black">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Dibuat</th>
                    @can('delete.users')
                        <th class="px-4 py-2">Aksi</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $i => $user)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-2">{{ $users->firstItem() + $i }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('users.detail', $user->id) }}"
                                class="font-bold text-gray-800 hover:underline">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($user->getRoleNames() as $role)
                                    <span class="badge bg-gray-200 text-black">{{ $role }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-4 py-2">{{ $user->created_at->format('d M Y') }}</td>
                        @can('delete.users')
                            <td class="px-4 py-2">
                                <div class="flex gap-2">
                                    <button wire:click="delete({{ $user->id }})"
                                        class="btn btn-xs btn-outline btn-error">Hapus</button>
                                </div>
                            </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada data user</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
