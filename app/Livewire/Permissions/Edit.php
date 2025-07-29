<?php
namespace App\Livewire\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Edit extends Component
{
    public $permissionId;
    public $name;
    public $display_name;

    public function mount($id)
    {
        $permission = Permission::findOrFail($id);
        $this->permissionId = $permission->id;
        $this->name = $permission->name;
        $this->display_name = $permission->display_name;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:permissions,name,' . $this->permissionId,
            'display_name' => 'nullable|string|max:255',
        ];
    }

    public function update()
    {
        $this->validate();

        $permission = Permission::findOrFail($this->permissionId);
        $permission->update([
            'name' => $this->name,
            'display_name' => $this->display_name,
        ]);

        session()->flash('success', 'Permission berhasil diupdate.');
        return redirect()->route('permissions.index');
    }

    public function render()
    {
        return view('livewire.permissions.edit');
    }
}