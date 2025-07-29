<div class="p-6 bg-white text-black rounded shadow max-w-4xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6 flex items-center gap-2 text-black">
        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-pencil h-6 w-6 text-primary" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M15 5l4 4m-6 2l6-6a2.828 2.828 0 00-4-4l-6 6v4h4zM4 20h4l10-10" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
        Edit Artikel
    </h2>

    <form wire:submit.prevent="update" class="space-y-6">

        {{-- Judul --}}
        <div class="form-control w-full">
            <label class="block text-sm font-medium mb-1 text-black">Judul Artikel</label>
            <input type="text" wire:model.defer="title"
                class="input w-full border border-gray-300 rounded bg-white text-black" />
            @error('title')
                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="form-control w-full">
            <label class="block text-sm font-medium mb-1 text-black">Kategori</label>
            <input type="text" wire:model.defer="category"
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
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
            @error('status')
                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Konten --}}
        {{-- Konten Artikel --}}
        <div class="form-control w-full" wire:ignore>
            <label class="block text-sm font-medium mb-1 text-black">Konten Artikel</label>
            <textarea x-data x-init="let editor = new EasyMDE({
                element: $el,
                spellChecker: false,
                status: false,
                toolbar: [
                    'bold', 'italic', 'heading', '|',
                    'unordered-list', 'ordered-list', '|',
                    'link',
                    {
                        name: 'upload-image',
                        action: function customImageUpload(editor) {
                            const input = document.createElement('input');
                            input.type = 'file';
                            input.accept = 'image/*';
                            input.onchange = async () => {
                                const file = input.files[0];
                                const formData = new FormData();
                                formData.append('image', file);
            
                                const response = await fetch('{{ route('articles.upload-image') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: formData
                                });
            
                                const data = await response.json();
                                if (data.file?.url) {
                                    const imageMarkdown = `![Alt Text](${data.file.url})`;
                                    editor.codemirror.replaceSelection(imageMarkdown);
                                }
                            };
                            input.click();
                        },
                        className: 'fa fa-image',
                        title: 'Upload Gambar'
                    },
                    'guide'
                ],
                initialValue: @js($content)
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
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
@endpush
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
@endpush
{{-- Naise --}}
