<div class="p-6 bg-white text-black rounded shadow max-w-3xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6 flex items-center gap-2 text-black">
        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-key-round h-6 w-6 text-primary" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="15" cy="15" r="5" />
            <path d="M21 21 19 19" />
            <path d="m22 13-3 3" />
            <path d="m17 18-1 1" />
        </svg>
        Edit Permission
    </h2>

    <form wire:submit.prevent="update" class="space-y-6">
        <div class="form-control w-full">
            <label class="block text-sm font-medium mb-1 text-black">Nama Permission</label>
            <input type="text" wire:model.defer="name"
                class="input w-full border border-gray-300 bg-white text-black" />
            @error('name')
                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('permissions.index') }}" class="btn btn-outline btn-neutral">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
