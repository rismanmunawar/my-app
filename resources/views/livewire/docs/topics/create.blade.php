<div class="p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-semibold mb-6">Tambah Topik</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Kolom Kiri - 1/3 --}}
        <div class="space-y-4 md:col-span-1">
            <div>
                <label class="label">Judul</label>
                <input wire:model="title" type="text"
                    class="input input-bordered w-full border-gray-300 rounded bg-white text-black" />
                @error('title')
                    <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="label">Kategori</label>
                <select wire:model="category_id"
                    class="select select-bordered w-full border-gray-300 rounded bg-white text-black">
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="label">Subkategori</label>
                <select wire:model="subcategory_id"
                    class="select select-bordered w-full border-gray-300 rounded bg-white text-black">
                    <option value="">-- Tidak ada --</option>
                    @foreach ($subcategories as $sub)
                        <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                    @endforeach
                </select>
                @error('subcategory_id')
                    <span class="text-error">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="label">Video URL (Opsional)</label>
                <input wire:model="video_url" type="url"
                    class="input input-bordered w-full border-gray-300 rounded bg-white text-black" />
                @error('video_url')
                    <span class="text-error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Kolom Kanan - 2/3 --}}
        <div class="space-y-2 md:col-span-2">
            <label class="label">Konten</label>
            <textarea wire:model="content"
                class="textarea textarea-bordered w-full border-gray-300 rounded bg-white text-black h-64"></textarea>
            @error('content')
                <span class="text-error">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- Tombol --}}
    <div class="flex justify-end gap-2 mt-6">
        <button wire:click="$dispatch('back-to-table')" class="btn btn-ghost">Batal</button>
        <button wire:click="store" class="btn btn-primary">Simpan</button>
    </div>
</div>
