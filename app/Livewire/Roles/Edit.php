<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
class Edit extends Component
{

    public Role $role;
    public $name;
    public bool $isEdit = false;
    public array $selectedPermissions = [];
    public array $allPermissions = [];
    public bool $showPermissions = true;

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|unique:roles,name,' . $this->role->id,
        ]);

        $this->role->update(['name' => $this->name]);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }
    
    public function render()
    {
        return view('livewire.roles.edit');
    }
}