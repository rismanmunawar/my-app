<div class="bg-white shadow-md rounded-lg p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4 border-b pb-2 text-black">
        {{ $isEdit ? '✏️ Edit User' : '➕ Tambah User' }}
    </h2>

    <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-black">

        <!-- Nama -->
        <div class="form-control">
            <label class="label text-black">
                <span class="label-text">Nama</span>
            </label>
            <input type="text" wire:model.defer="name" class="input input-bordered w-full bg-white text-black"
                placeholder="Nama Lengkap">
            @error('name')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-control">
            <label class="label text-black">
                <span class="label-text">Email</span>
            </label>
            <input type="email" wire:model.defer="email" class="input input-bordered w-full bg-white text-black"
                placeholder="Email">
            @error('email')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-control md:col-span-2">
            <label class="label text-black">
                <span class="label-text">Password
                    {{ $isEdit ? '(biarkan kosong jika tidak ingin mengganti)' : '' }}</span>
            </label>
            <input type="password" wire:model.defer="password" class="input input-bordered w-full bg-white text-black"
                placeholder="Password">
            @error('password')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Role -->
        <div class="form-control md:col-span-2">
            <label class="label text-black">
                <span class="label-text">Role</span>
            </label>
            <select wire:model="role" class="select select-bordered w-full bg-white text-black">
                <option value="">- Pilih Role -</option>
                @foreach ($roles as $roleName => $label)
                    <option value="{{ $roleName }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('role')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tombol Aksi -->
        <div class="md:col-span-2 flex justify-end gap-2 mt-4">
            <button type="button" wire:click="resetForm" class="btn btn-outline btn-secondary">
                Batal
            </button>
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? '💾 Update' : '➕ Simpan' }}
            </button>
        </div>
    </form>
</div>
