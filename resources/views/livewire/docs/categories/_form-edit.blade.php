<form wire:submit.prevent="update" class="space-y-3">
    <div>
        <label class="font-semibold">Edit Kategori</label>
        <input type="text" wire:model.defer="name" class="input input-bordered w-full" />
        @error('name')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex gap-2">
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="button" wire:click="cancelEdit" class="btn btn-ghost">Batal</button>
    </div>
</form>
