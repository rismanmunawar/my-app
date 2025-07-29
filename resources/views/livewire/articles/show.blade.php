<div class="p-6 bg-white text-black rounded shadow max-w-4xl mx-auto space-y-6">

    {{-- Judul --}}
    <div>
        <h1 class="text-3xl font-bold text-black mb-2">{{ $article->title }}</h1>
        <p class="text-sm text-gray-600">
            Created by <span class="font-medium">{{ $article->author->name }}</span>
            @if ($article->published_at)
                • Published on {{ $article->published_at->format('d M Y') }}
            @else
                • <span class="text-yellow-600">Not published</span>
            @endif
        </p>
    </div>

    {{-- Kategori & Status --}}
    <div class="flex flex-wrap items-center gap-4 text-sm">
        <span class="badge badge-outline">{{ $article->category }}</span>
        <span class="badge {{ $article->status === 'published' ? 'badge-success' : 'badge-warning' }}">
            {{ ucfirst($article->status) }}
        </span>
    </div>

    {{-- Konten --}}
    {{-- Konten --}}
    <div
        class="prose max-w-none bg-white border p-4 leading-tight text-sm tracking-tight text-black
    prose-p:my-0 prose-li:my-0 prose-h1:text-black prose-h2:text-black prose-h3:text-black
    prose-strong:text-black prose-em:text-black prose-a:text-black prose-code:text-black
    prose-ol:marker:text-black prose-ul:marker:text-black
    prose-ul:list-disc prose-ol:list-decimal prose-ul:pl-4 prose-ol:pl-4
    [&_ul>li::marker]:text-black [&_ol>li::marker]:text-black">
        {!! Str::markdown($article->content) !!}
    </div>





    {{-- Tombol Aksi --}}
    <div class="flex justify-end mt-6">
        <a href="{{ route('articles.index') }}" class="btn btn-sm btn-neutral">← Kembali ke Daftar</a>
    </div>

</div>
