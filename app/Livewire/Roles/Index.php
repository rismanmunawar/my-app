<?php

namespace App\Livewire\Roles;

use Spatie\Permission\Models\Role;
use Livewire\Component;

class Index extends Component
{
    public $roles;

    public function mount()
    {
        $this->loadRoles();
    }

    public function loadRoles()
    {
        $this->roles = Role::with('permissions')->get();
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);

        // Jika perlu, tambahkan pengecekan agar tidak menghapus super-admin misalnya
        // if ($role->name === 'super-admin') {
        //     session()->flash('error', 'Role ini tidak bisa dihapus.');
        //     return;
        // }

        $role->delete();

        $this->loadRoles();

        session()->flash('success', 'Role berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.roles.index');
    }
}