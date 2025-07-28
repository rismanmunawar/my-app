<?php

namespace App\Livewire\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        session()->flash('success', 'Permission berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.permissions.index', [
            'permissions' => Permission::latest()->paginate(10),
        ]);
    }
}