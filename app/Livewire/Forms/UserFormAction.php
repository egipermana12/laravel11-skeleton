<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class UserFormAction extends Form
{
    public ?User $user;

    #[Locked]
    public $id = '';

    #[Rule('required|string|max:255')]
    public string $name = '';

    #[Rule('required|string|lowercase|email|max:255|unique:'.User::class.',email')]
    public string $email = '';

    #[Rule('required|string|max:255|min:4')]
    public string $password = '';

    #[Rule('required')]
    public string $roles = '';

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles = $user->roles->first()->id ?? null;
    }

    public function store()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();
        
        $roleName = Role::findById($this->roles)->name;
        if($roleName){
            $user->assignRole($roleName);
        }

        return $user;
    }

    public function update()
    {
       
    }

    public function delete(User $user)
    {
        $this->user = $user;
        $this->user->syncRoles([]);
        return $this->user->delete();
    }
}
