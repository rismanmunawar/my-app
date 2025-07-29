<div>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Manajemen Topik</h2>
        @if ($mode === 'table')
            <button wire:click="showCreate" class="btn btn-primary">Tambah Topik</button>
        @endif
    </div>

    @if ($mode === 'table')
        @livewire('docs.topics.table')
    @elseif ($mode === 'create')
        @livewire('docs.topics.create', key('create-topic'))
    @elseif ($mode === 'edit' && $editingTopicId)
        @livewire('docs.topics.edit', ['topicId' => $editingTopicId], key('edit-topic-' . $editingTopicId))
    @endif


</div>
