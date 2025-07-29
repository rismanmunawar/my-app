<?php

namespace App\Livewire\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    public $name;
    public $display_name;
    protected $rules = [
        'name' => 'required|string|max:255|unique:permissions,name',
        'display_name' => 'nullable|string|max:255',
    ];

    public function save()
    {
        $this->validate();

         Permission::create([
        'name' => $this->name,
        'display_name' => $this->display_name,
        ]);

        session()->flash('success', 'Permission berhasil ditambahkan.');
        return redirect()->route('permissions.index');
    }

    public function render()
    {
        return view('livewire.permissions.create');
    }
}