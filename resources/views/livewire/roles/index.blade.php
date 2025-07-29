<div class="p-4 bg-white text-black rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Role</h2>
        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm inline-flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Role
        </a>
    </div>

    {{-- ALERT SECTION --}}
    @if (session('success') || session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition>
            <div class="alert shadow-lg mb-4 {{ session('success') ? 'alert-success' : 'alert-error' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    @if (session('success'))
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    @endif
                </svg>
                <span>{{ session('success') ?? session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- TABLE --}}
    <div class="mt-6 overflow-x-auto">
        <table class="table text-black bg-white border border-gray-200 w-full">
            <thead class="bg-gray-100 text-black">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nama Role</th>
                    <th class="px-4 py-2">Permission</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $i => $role)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-2">{{ $i + 1 }}</td>
                        <td class="px-4 py-2">{{ $role->name }}</td>
                        <td class="px-4 py-2">
                            <span class="badge badge-ghost badge-outline">
                                {{ $role->permissions->count() }} permission
                            </span>
                        </td>

                        <td class="px-4 py-2">
                            <div class="flex gap-2">
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-xs btn-warning">Edit</a>
                                <a href="{{ route('roles.permissions', $role->id) }}" class="btn btn-xs btn-info">Kelola
                                    Permission</a>
                                <button
                                    onclick="confirm('Yakin ingin menghapus role ini?') || event.stopImmediatePropagation()"
                                    wire:click="delete({{ $role->id }})" class="btn btn-xs btn-outline btn-error">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">Tidak ada data role</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
