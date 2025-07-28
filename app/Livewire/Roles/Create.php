<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
class Create extends Component
{

    public $name;
    public bool $isEdit = false;
    public array $selectedPermissions = [];
    public array $allPermissions = [];
    public bool $showPermissions = true;
    public function save()
    {
        $this->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create([
            'name' => $this->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    
    public function render()
    {
        return view('livewire.roles.create');
    }
}