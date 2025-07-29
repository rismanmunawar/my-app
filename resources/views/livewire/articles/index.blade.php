<div class="p-4 bg-white text-black rounded-lg shadow">
    {{-- Header + Search --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4">
        <h2 class="text-xl font-bold">Daftar Artikel</h2>
        <div class="flex gap-2 items-center w-full md:w-auto">
            <input wire:model.debounce.500ms="search" type="text" placeholder="Cari judul artikel..."
                class="input input-bordered input-sm w-full md:w-64 border-gray-300 rounded bg-white text-black" />
            @can('create.articles')
                <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Artikel
                </a>
            @endcan
        </div>
    </div>

    {{-- Success Alert --}}
    @if (session()->has('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    {{-- Table --}}
    <div class="mt-4 overflow-x-auto">
        <table class="table text-black bg-white border border-gray-200 w-full">
            <thead class="bg-gray-100 text-black">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Judul</th>
                    <th class="px-4 py-2">Author</th>
                    <th class="px-4 py-2">Dipublikasikan</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $i => $article)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-2">{{ $articles->firstItem() + $i }}</td>
                        <td class="px-4 py-2 font-semibold">{{ $article->title }}</td>
                        <td class="px-4 py-2">{{ $article->author->name }}</td>
                        <td class="px-4 py-2">{{ $article->published_at?->format('d M Y') ?? '-' }}</td>
                        <td class="px-4 py-2 flex gap-1">
                            <a href="{{ route('articles.edit', $article->id) }}"
                                class="btn btn-xs btn-outline btn-warning">Edit</a>
                            <a href="{{ route('articles.show', $article->id) }}"
                                class="btn btn-xs btn-outline btn-info">Show</a>
                            <button wire:click="deleteArticle({{ $article->id }})"
                                class="btn btn-xs btn-outline btn-error">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">Belum ada artikel</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>
</div>
