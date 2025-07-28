<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class Form extends Component
{
    public $userId, $name, $email, $password, $role;
    public $isEdit = false;

    protected $listeners = ['editUser' => 'loadUser'];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'nullable|min:6',
        'role' => 'required'
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = '';
        $this->isEdit = false;
    }

    public function loadUser($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->pluck('name')->first();
        $this->isEdit = true;
    }

    public function save()
    {
        $this->validate();

        $user = $this->userId ? User::find($this->userId) : new User();
        $user->name = $this->name;
        $user->email = $this->email;
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        $user->save();

        $user->syncRoles([$this->role]);

        $this->dispatch('userSaved');
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.users.form', [
            'roles' => Role::pluck('name', 'name')
        ]);
    }
}