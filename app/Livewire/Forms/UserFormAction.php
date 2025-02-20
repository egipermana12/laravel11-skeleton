<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UserFormAction extends Form
{
    public ?User $user;

    #[Rule('required|string|max:255')]
    public string $name = '';

    #[Rule('required|string|lowercase|email|max:255|unique:'.User::class.',email')]
    public string $email = '';

    #[Rule('required|string|max:255|min:8')]
    public string $password = '';

    #[Rule('required')]
    public string $roles = '';

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles = $user->roles;
    }

    public function store()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();
        $user->assignRole($this->roles);

        return $user;
    }

    public function update()
    {
       
    }
}
