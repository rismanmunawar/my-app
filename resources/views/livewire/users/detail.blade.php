<div class="p-6 bg-white text-black rounded shadow max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">🧑‍💼 Detail & Permission User</h2>

        <div class="flex gap-2">
            @if (!$isEditMode)
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline btn-secondary">🔙 Back</a>
                <button wire:click="enableEdit" class="btn btn-sm btn-outline btn-primary">✏️ Edit</button>
            @else
                <button wire:click="cancelEdit" class="btn btn-sm btn-outline btn-warning">↩️ Batal</button>
                <button wire:click="updateUserAndPermissions" wire:loading.attr="disabled"
                    class="btn btn-sm bg-black text-white hover:bg-gray-800 disabled:bg-gray-700 disabled:text-gray-300">
                    <span wire:loading.remove>💾 Simpan</span>
                    <span wire:loading class="text-black">⏳ Menyimpan...</span>
                </button>
            @endif
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- 🔹 KIRI: Detail User --}}
        <div class="space-y-4">
            <div>
                <label class="font-semibold">Nama:</label><br>
                @if ($isEditMode)
                    <input type="text" wire:model.defer="name"
                        class="input w-full border border-gray-300 rounded bg-white">
                    @error('name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                @else
                    <div>{{ $user->name }}</div>
                @endif
            </div>

            <div>
                <label class="font-semibold">Email:</label><br>
                @if ($isEditMode)
                    <input type="email" wire:model.defer="email"
                        class="input w-full border border-gray-300 rounded bg-white">
                    @error('email')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                @else
                    <div>{{ $user->email }}</div>
                @endif
            </div>

            <div>
                <label class="font-semibold">Role:</label><br>
                @if ($isEditMode)
                    <select wire:model="selectedRole"
                        class="select-bordered border-gray-300 rounded w-full bg-white text-black">
                        <option value="">-- Pilih Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                    @error('selectedRole')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                @else
                    <div class="flex flex-wrap gap-1 mt-1">
                        @forelse ($user->getRoleNames() as $role)
                            <span class="badge bg-blue-100 text-blue-800">{{ $role }}</span>
                        @empty
                            <span class="text-gray-500 italic">Tidak ada role</span>
                        @endforelse
                    </div>
                @endif
            </div>


            <div>
                <span class="font-semibold">Bergabung:</span> {{ $user->created_at->format('d M Y') }}
            </div>

            <div>
                <span class="font-semibold">Total Permission Khusus:</span> {{ count($selectedPermissions) }}
            </div>
        </div>

        {{-- 🔸 KANAN: Assign Permission --}}
        <div>
            <h3 class="text-lg font-semibold mb-3">🔐 Permission</h3>

            <div class="flex items-center gap-3 mb-4">
                <button wire:click="copyFromRole" type="button" class="btn btn-xs btn-outline btn-info">
                    🔁 Copy dari Role
                </button>
                <button wire:click="resetPermissions" type="button" class="btn btn-xs btn-outline btn-error">
                    🗑️ Reset ke Default
                </button>
            </div>

            <div class="max-h-80 overflow-y-auto border rounded p-3 bg-gray-50">
                @forelse ($groupedPermissions as $module => $permissions)
                    <div class="collapse collapse-arrow bg-white border mb-2">
                        <input type="checkbox" />
                        <div class="collapse-title text-sm font-semibold">
                            📁 Modul: {{ ucfirst($module) }}
                        </div>
                        <div class="collapse-content">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach ($permissions as $permission)
                                    @php
                                        $isChecked = in_array($permission->name, $selectedPermissions);
                                    @endphp

                                    <label class="cursor-pointer label justify-start gap-2">
                                        @if ($isEditMode)
                                            <input type="checkbox" wire:model="selectedPermissions"
                                                value="{{ $permission->name }}"
                                                class="checkbox checkbox-sm peer
                       checked:bg-purple-600 checked:border-purple-600
                       focus:ring-0 focus:outline-none
                       transition-colors duration-200
                       bg-white border-gray-300" />
                                        @else
                                            <input type="checkbox" value="{{ $permission->name }}"
                                                class="checkbox checkbox-sm disabled:opacity-100
                       checked:bg-purple-600 checked:border-purple-600
                       bg-white border-gray-300"
                                                {{ $isChecked ? 'checked' : '' }} disabled />
                                        @endif

                                        <span class="label-text text-sm peer-checked:text-purple-700">
                                            {{ $permission->display_name ?? $permission->name }}
                                        </span>
                                    </label>
                                @endforeach

                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 italic">Tidak ada permission yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
