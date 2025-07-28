<?php

namespace App\Livewire\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255|unique:permissions,name',
    ];

    public function save()
    {
        $this->validate();

        Permission::create(['name' => $this->name]);

        session()->flash('success', 'Permission berhasil ditambahkan.');
        return redirect()->route('permissions.index');
    }

    public function render()
    {
        return view('livewire.permissions.create');
    }
}