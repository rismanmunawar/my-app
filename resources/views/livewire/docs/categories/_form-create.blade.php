<form wire:submit.prevent="create" class="space-y-3">
    <div>
        <label class="font-semibold">Nama Kategori</label>
        <input type="text" wire:model.defer="name"
            class="input input-bordered w-full bg-white border border-gray-200 rounded text-black"
            placeholder="Contoh: Backend" />
        @error('name')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Tambah Kategori</button>
</form>
