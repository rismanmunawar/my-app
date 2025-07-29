<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Detail extends Component
{
    public User $user;
    public string $name;
    public string $email;
    public string $selectedRole = '';
    public array $roles = [];
    public array $selectedPermissions = [];
    public array $groupedPermissions = [];
    public bool $isEditMode = false;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRole = $user->roles->pluck('name')->first() ?? '';
        $this->selectedPermissions = $user->permissions->pluck('name')->toArray();

        $this->roles = Role::pluck('name')->toArray();

        $this->groupedPermissions = Permission::all()
            ->groupBy(function ($permission) {
                return explode('.', $permission->name)[1] ?? 'other';
            })
            ->map(fn ($group) => $group->sortBy('name')->values()->all())
            ->toArray();
    }

    public function updatedSelectedRole($value)
    {
        // Jika role diubah, otomatis ambil permission dari role tsb
        $role = Role::where('name', $value)->first();
        if ($role) {
            $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
        }
    }

    public function enableEdit()
    {
        $this->isEditMode = true;
    }

    public function cancelEdit()
    {
        $this->isEditMode = false;

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->selectedRole = $this->user->roles->pluck('name')->first() ?? '';
        $this->selectedPermissions = $this->user->permissions->pluck('name')->toArray();
    }

    public function updateUserAndPermissions()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'selectedRole' => 'required|exists:roles,name',
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Ganti role & permission
        $this->user->syncRoles([$this->selectedRole]);
        $this->user->syncPermissions($this->selectedPermissions);

        $this->isEditMode = false;
        session()->flash('success', 'User, role, dan permission berhasil diperbarui.');
    }

    public function copyFromRole()
    {
        $role = Role::where('name', $this->selectedRole)->first();
        if ($role) {
            $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
            session()->flash('success', 'Permission disalin dari role.');
        }
    }

    public function resetPermissions()
    {
        $this->selectedPermissions = [];
        $this->user->syncPermissions([]);
        session()->flash('success', 'Semua permission direset.');
    }

    public function render()
    {
        return view('livewire.users.detail');
    }

    
}