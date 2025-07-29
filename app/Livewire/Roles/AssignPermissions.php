<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissions extends Component
{
    public Role $role;
    public $permissions = [];
    public $selectedPermissions = [];
    public $groupedPermissions = [];
    public $search = ''; 
    public $collapsedModules = [];

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->permissions = Permission::all();
$this->selectedPermissions = $role->permissions->pluck('name')->toArray();

        $grouped = [];

        foreach ($this->permissions as $permission) {
            $parts = explode('.', $permission->name);
            $module = $parts[1] ?? 'other';

            if (!isset($grouped[$module])) {
                $grouped[$module] = [
                    'label' => ucfirst($module),
                    'permissions' => [],
                ];
            }

            $grouped[$module]['permissions'][] = $permission;
        }

        $this->groupedPermissions = $grouped;
        $this->collapsedModules = array_fill_keys(array_keys($grouped), false);
    }

    public function toggleModule($module)
    {
        $this->collapsedModules[$module] = !$this->collapsedModules[$module];
    }

    public function toggleAllInModule($module)
    {
        $ids = collect($this->groupedPermissions[$module]['permissions'])->pluck('id')->toArray();

        if (count(array_intersect($ids, $this->selectedPermissions)) === count($ids)) {
            $this->selectedPermissions = array_diff($this->selectedPermissions, $ids);
        } else {
            $this->selectedPermissions = array_unique(array_merge($this->selectedPermissions, $ids));
        }
    }

    public function updatePermissions()
    {
        $this->role->syncPermissions($this->selectedPermissions);
        session()->flash('success', 'Permissions berhasil disimpan.');
         return redirect()->route('roles.index');
    }

    public function render()
    {
        return view('livewire.roles.assign-permissions');
    }
}