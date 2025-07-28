@if ($paginator->hasPages())
    <div class="mt-4 flex justify-center">
        <div class="join">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="join-item btn btn-disabled">«</button>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled" class="join-item btn">«</button>
            @endif

            {{-- Page Number --}}
            <button class="join-item btn btn-ghost cursor-default">Page {{ $paginator->currentPage() }} /
                {{ $paginator->lastPage() }}</button>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled" class="join-item btn">»</button>
            @else
                <button class="join-item btn btn-disabled">»</button>
            @endif
        </div>
    </div>
@endif
