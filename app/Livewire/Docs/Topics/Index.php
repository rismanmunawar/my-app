<?php

namespace App\Livewire\Docs\Topics;

use Livewire\Component;

class Index extends Component
{
    public $mode = 'table';
    public $editingTopicId = null;

    protected $listeners = [
        'topic-created' => 'showTable',
        'topic-updated' => 'showTable',
        'back-to-table' => 'showTable',
        'edit-topic' => 'editTopic',
    ];

    public function showCreate()
    {
        $this->mode = 'create';
    }

    public function showTable()
    {
        $this->mode = 'table';
        $this->editingTopicId = null;
    }

    public function editTopic($id)
    {
        $this->editingTopicId = $id;
        $this->mode = 'edit';
    }

    public function render()
    {
        return view('livewire.docs.topics.index');
    }
}
