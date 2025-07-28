<div class="p-6 bg-white text-black rounded shadow max-w-6xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6 flex items-center gap-2 text-black">
        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-plus h-6 w-6 text-primary" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M5 12h14M12 5v14" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Tambah User
    </h2>


    <form wire:submit.prevent="save" class="space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- KIRI --}}
            <div class="space-y-6">
                {{-- Nama --}}
                <div class="form-control w-full">
                    <label class="block text-sm font-medium mb-1 text-black">Nama</label>
                    <div class="relative">
                        <input type="text" wire:model.defer="name" placeholder="Nama lengkap" required
                            class="input w-full border border-gray-300 rounded bg-white text-black pl-10" />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A9.001 9.001 0 0112 15c2.05 0 3.932.688 5.414 1.844M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    @error('name')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-control w-full">
                    <label class="block text-sm font-medium mb-1 text-black">Email</label>
                    <div class="relative">
                        <input type="email" wire:model.defer="email" placeholder="mail@site.com" required
                            class="input w-full border border-gray-300 rounded bg-white text-black pl-10" />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-control w-full">
                    <label class="block text-sm font-medium mb-1 text-black">Password</label>
                    <div class="relative">
                        <input id="passwordInput" type="password" wire:model.defer="password"
                            placeholder="Minimal 6 karakter" required
                            class="input w-full border border-gray-300 rounded bg-white text-black pl-10 pr-10" />

                        <!-- Icon kiri -->
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m0-6a4 4 0 014 4v1a4 4 0 01-4 4m0-9a4 4 0 00-4 4v1a4 4 0 004 4m0-9V9a4 4 0 00-8 0v2" />
                            </svg>
                        </div>

                        <!-- Toggle password -->
                        <button type="button" onclick="togglePasswordVisibility()"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                            <!-- Eye open -->
                            <svg id="eyeIconOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm9 0s-4.5 8-12 8S0 12 0 12s4.5-8 12-8 12 8 12 8z" />
                            </svg>
                            <!-- Eye closed -->
                            <svg id="eyeIconClosed" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10 0-1.2.213-2.356.6-3.425M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>

                        <script>
                            function togglePasswordVisibility() {
                                const input = document.getElementById('passwordInput');
                                const eyeOpen = document.getElementById('eyeIconOpen');
                                const eyeClosed = document.getElementById('eyeIconClosed');

                                const isPassword = input.type === 'password';
                                input.type = isPassword ? 'text' : 'password';

                                eyeOpen.classList.toggle('hidden', !isPassword);
                                eyeClosed.classList.toggle('hidden', isPassword);
                            }
                        </script>
                    </div>
                    @error('password')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-sm mb-1 font-medium">Role</label>
                    <select wire:model.defer="role"
                        class="select select-bordered border-gray-300 rounded w-full bg-white text-black">
                        <option value="">Pilih Role</option>
                        @foreach ($roles as $r)
                            <option value="{{ $r }}">{{ $r }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- KANAN --}}
            <div class="space-y-6">
                <div
                    class="border-dashed border-2 border-gray-200 rounded-lg min-h-[300px] flex items-center justify-center text-gray-400 text-sm">
                    Area kosong (misalnya bisa nanti untuk avatar, preview user, dll)
                </div>
            </div>
        </div>

        {{-- TOMBOL --}}
        <div class="flex justify-end gap-2 pt-6">
            <a href="{{ route('users.index') }}" class="btn btn-outline btn-neutral">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
