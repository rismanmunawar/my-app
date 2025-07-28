<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $name, $email, $password, $role;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required'
    ];

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole($this->role);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function render()
    {
        return view('livewire.users.create', [
            'roles' => Role::pluck('name', 'name')
        ]);
    }
}