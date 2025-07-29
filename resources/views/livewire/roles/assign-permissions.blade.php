<div class="p-6 bg-white text-black rounded shadow max-w-5xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-shield h-6 w-6 text-primary" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Kelola Permissions untuk Role: <span class="font-bold">{{ $role->name }}</span>
    </h2>

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <input type="text" wire:model.live="search" placeholder="Cari permission..."
            class="input bg-white text-black placeholder-gray-500 border-gray-300 focus:border-primary-500 focus:ring-primary-500 input-bordered w-full max-w-md" />
    </div>

    <form wire:submit.prevent="updatePermissions" class="space-y-6">
        @forelse ($groupedPermissions as $module => $data)
            @php
                $searchValue = $search;
                $filtered = collect($data['permissions'])->filter(function ($p) use ($searchValue) {
                    return stripos($p->name, $searchValue) !== false;
                });
                $allIds = $filtered->pluck('id')->toArray();
                $isAllChecked = count(array_intersect($allIds, $selectedPermissions)) === count($allIds);
            @endphp

            @if ($filtered->isNotEmpty())
                <div class="border border-gray-200 rounded">
                    <div class="flex items-center justify-between bg-gray-100 px-4 py-2 cursor-pointer"
                        wire:click="toggleModule('{{ $module }}')">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" wire:click.stop="toggleAllInModule('{{ $module }}')"
                                @checked($isAllChecked) class="checkbox checkbox-sm checkbox-primary" />
                            <h3 class="font-bold text-lg text-primary">{{ $data['label'] }}</h3>
                        </div>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-200"
                                :class="{ 'rotate-180': {{ $collapsedModules[$module] ? 'false' : 'true' }} }"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>

                    @if (!$collapsedModules[$module])
                        <div class="p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach ($filtered as $permission)
                                <label class="flex items-center gap-3 p-3 rounded bg-gray-50 border border-gray-200">
                                    <input type="checkbox" wire:model="selectedPermissions"
                                        value="{{ $permission->name }}" class="checkbox checkbox-primary" />
                                    <span class="text-sm">
                                        {{ $permission->display_name ?? Str::headline(Str::after($permission->name, '.')) }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        @empty
            <div class="text-gray-500">Tidak ada permissions tersedia.</div>
        @endforelse

        <div class="flex justify-end gap-3 pt-6">
            <a href="{{ route('roles.index') }}" class="btn btn-outline btn-neutral">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
