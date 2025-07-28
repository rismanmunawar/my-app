<?php
namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $users;

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->users = User::with('roles')->latest()->get();
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        $this->loadUsers();
    }

    public function render()
    {
        return view('livewire.users.index');
    }
}