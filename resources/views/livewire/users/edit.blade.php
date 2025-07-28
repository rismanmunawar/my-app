<div class="p-6 bg-white text-black rounded shadow max-w-6xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6">✏️ Edit User</h2>

    <form wire:submit.prevent="update" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- KIRI --}}
            <div class="space-y-6">
                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Nama</label>
                    <input type="text" wire:model.defer="name"
                        class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-black focus:outline-none focus:ring focus:ring-primary"
                        placeholder="Nama lengkap" required />
                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" wire:model.defer="email"
                        class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-black focus:outline-none focus:ring focus:ring-primary"
                        placeholder="mail@site.com" required />
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Password (opsional)</label>
                    <input type="password" wire:model.defer="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-black focus:outline-none focus:ring focus:ring-primary"
                        placeholder="Biarkan kosong jika tidak diganti" />
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Role</label>
                    <select wire:model.defer="role"
                        class="w-full px-3 py-2 border border-gray-300 rounded bg-white text-black focus:outline-none focus:ring focus:ring-primary">
                        <option value="">Pilih Role</option>
                        @foreach ($roles as $r)
                            <option value="{{ $r }}">{{ $r }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- KANAN --}}
            <div class="space-y-6">
                <div
                    class="border-dashed border-2 border-gray-200 rounded-lg min-h-[300px] flex items-center justify-center text-gray-400 text-sm">
                    Area kosong (misalnya untuk avatar, info user, dll)
                </div>
            </div>
        </div>

        {{-- TOMBOL --}}
        <div class="flex justify-end gap-2 pt-6">
            <a href="{{ route('users.index') }}" class="btn btn-outline btn-neutral">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
