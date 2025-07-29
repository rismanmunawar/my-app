<div class="p-6 bg-white rounded shadow max-w-6xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6">Edit Topik</h2>

    <form wire:submit.prevent="update" class="space-y-4">
        <div>
            <label class="block font-semibold mb-1">Judul</label>
            <input type="text" wire:model.defer="title" class="input input-bordered w-full" />
            @error('title')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Kategori</label>
            <select wire:model="category_id" class="select select-bordered w-full">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Subkategori</label>
            <select wire:model="subcategory_id" class="select select-bordered w-full">
                <option value="">-- Pilih Subkategori --</option>
                @foreach ($subcategories as $sub)
                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                @endforeach
            </select>
            @error('subcategory_id')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Konten</label>
            <textarea wire:model.defer="content" rows="6" class="textarea textarea-bordered w-full"></textarea>
            @error('content')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Video URL (opsional)</label>
            <input type="text" wire:model.defer="video_url" class="input input-bordered w-full" />
            @error('video_url')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-between mt-6">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <button type="button" wire:click="$dispatch('back-to-table')" class="btn">Batal</button>
        </div>
    </form>
</div>
