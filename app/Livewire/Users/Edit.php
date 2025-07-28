<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $userId, $name, $email, $password, $role;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email:users,email,{userId}',
        'password' => 'nullable|min:6',
        'role' => 'required'
    ];

    public function mount($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->pluck('name')->first();
    }

    public function update()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        $user->save();

        $user->syncRoles([$this->role]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function render()
    {
        return view('livewire.users.edit', [
            'roles' => Role::pluck('name', 'name')
        ]);
    }
}