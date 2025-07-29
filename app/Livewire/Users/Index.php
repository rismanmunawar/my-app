<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind'; // gunakan Tailwind agar cocok dengan DaisyUI

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
    }

    public function render()
    {
        $users = User::with('roles')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.users.index', compact('users'));
    }
}