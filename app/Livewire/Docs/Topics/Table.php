<?php

namespace App\Livewire\Docs\Topics;

use App\Models\Docs\Topic;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        Topic::findOrFail($id)->delete();
        session()->flash('message', 'Topik berhasil dihapus.');
    }

    public function render()
    {
        $topics = Topic::query()
            ->with(['category', 'subcategory'])
            ->when(
                $this->search,
                fn($q) =>
                $q->where('title', 'like', '%' . $this->search . '%')
            )
            ->latest()
            ->paginate(10);

        return view('livewire.docs.topics.table', compact('topics'));
    }
}
