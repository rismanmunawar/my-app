<div class="p-6 bg-white text-black rounded shadow max-w-4xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6 flex items-center gap-2 text-black">
        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-plus h-6 w-6 text-primary" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M5 12h14M12 5v14" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Tambah Artikel
    </h2>

    <form wire:submit.prevent="save" class="space-y-6">

        {{-- Judul --}}
        <div class="form-control w-full">
            <label class="block text-sm font-medium mb-1 text-black">Judul Artikel</label>
            <input type="text" wire:model.defer="title" placeholder="Masukkan judul artikel"
                class="input w-full border border-gray-300 rounded bg-white text-black" />
            @error('title')
                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="form-control w-full">
            <label class="block text-sm font-medium mb-1 text-black">Kategori</label>
            <input type="text" wire:model.defer="category" placeholder="Misalnya: Jaringan, Software, dll"
                class="input w-full border border-gray-300 rounded bg-white text-black" />
            @error('category')
                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Status --}}
        <div class="form-control w-full">
            <label class="block text-sm font-medium mb-1 text-black">Status</label>
            <select wire:model.defer="status"
                class="select select-bordered border-gray-300 rounded w-full bg-white text-black">
                <option value="">Pilih Status</option>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
            @error('status')
                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Konten --}}
        <div class="form-control w-full" wire:ignore>
            <label class="block text-sm font-medium mb-1 text-black">Konten Artikel</label>
            <textarea x-data x-init="const editor = new EasyMDE({
                element: $el,
                spellChecker: false,
                status: false,
                toolbar: [
                    'bold', 'italic', 'heading', '|',
                    'unordered-list', 'ordered-list', '|',
                    'link', {
                        name: 'image',
                        action: function customImageUploadFunction(editor) {
                            const input = document.createElement('input');
                            input.type = 'file';
                            input.accept = 'image/*';
                            input.onchange = async () => {
                                const file = input.files[0];
                                const formData = new FormData();
                                formData.append('image', file);
            
                                try {
                                    const response = await fetch('{{ route('articles.upload-image') }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: formData
                                    });
            
                                    const result = await response.json();
            
                                    if (result.success) {
                                        const imageUrl = result.file.url;
                                        const cm = editor.codemirror;
                                        const output = `![alt text](${imageUrl})`;
                                        cm.replaceSelection(output);
                                    } else {
                                        alert('Upload gagal!');
                                    }
                                } catch (error) {
                                    alert('Terjadi kesalahan saat mengupload gambar.');
                                }
                            };
                            input.click();
                        },
                        className: 'fa fa-image',
                        title: 'Insert Image',
                    },
                    'guide'
                ]
            });
            
            editor.codemirror.on('change', () => {
                @this.set('content', editor.value());
            });" class="textarea w-full min-h-[300px] bg-white text-black"></textarea>


            @error('content')
                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
            @enderror
        </div>


        {{-- Tombol --}}
        <div class="flex justify-end gap-2 pt-6">
            <a href="{{ route('articles.index') }}" class="btn btn-outline btn-neutral">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
@endpush
