<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Locked;
use Illuminate\Validation\Rule;
use Livewire\Form;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserFormAction extends Form
{
    public ?User $user;

    #[Locked]
    public $id = '';

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $roles = '2';

    public array $permissions = [
        'anggota' => 'anggota.disable',
        'simpanan' => 'simpanan.disable',
        'pinjaman' => 'pinjaman.disable',
        'transaksi' => 'transaksi.disable',
    ];

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:4',
            ],
            'roles' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->id)
            ],
            'permissions' => [
                'required',
                'array',
            ],
        ];
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        // Do not assign the hashed password to the password property
        $this->password = $user->password;
        $this->roles = $user->roles->first()->id ?? $this->roles;
        $this->permissions = $user->getAllPermissions()
        ->mapWithKeys(function ($perm) {
            $modul = explode('.', $perm->name)[0];
            return [$modul => $perm->name];
        })
        ->toArray();
    }

    public function store()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();
        
        //asisgn role
        $roleName = Role::findById($this->roles)->name;
        if($roleName){
            $user->assignRole($roleName);
        }

        //assign permission
        if($this->permissions){
            foreach($this->permissions as $permissionKey => $permissionValue){
                if (Permission::where('name', $permissionValue)->exists()) {
                    $user->givePermissionTo($permissionValue);
                }
            }
        }

        return $user;
    }

    public function update()
    {
       $this->validate();
       
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->save();

        $roleName = Role::findById($this->roles)->name;
        if($roleName){
            $this->user->syncRoles([$roleName]);
        }

        // Pastikan semua permissions disimpan dengan benar
        if ($this->permissions) {
            $validPermissions = array_filter($this->permissions, function ($permissionValue) {
                return Permission::where('name', $permissionValue)->exists();
            });

            // Simpan semua permissions dalam satu kali panggilan
            $this->user->syncPermissions($validPermissions);
        }

        return $this->user;
    }

    public function delete(User $user)
    {
        $this->user = $user;
        $this->user->syncRoles([]);
        $this->user->syncPermissions([]);
        return $this->user->delete();
    }
}
