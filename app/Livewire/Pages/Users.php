<?php

namespace App\Livewire\Pages;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $cariUser = '';
    public $cariRole = '';
    public $pageStart = 10;
    public $checked = [];
    public $selectAll = false;

    public function fetchUsers()
    {

        $query = User::query()->with('roles');

        if (!empty($this->cariUser)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->cariUser.'%')
                    ->orWhere('email', 'like', '%'.$this->cariUser.'%');
            });
        }

        if (!empty($this->cariRole)) {
            $query->whereHas('roles', function ($q) {
                $q->where('id', $this->cariRole);
            });
        }

        $users = $query->orderBy('id')->paginate($this->pageStart);
        return $users;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = $this->fetchUsers()->pluck('id')->map(fn ($item) => (string) $item)->toArray();
        } else {
            $this->checked = [];
        }
    }

    public function updatedChecked()
    {
        $this->selectAll = false;
    }

    public function isChecked($id)
    {
        return in_array($id, $this->checked);
    }

    public function updating($key): void
    {
        if ($key === 'cariUser' || $key === 'cariRole' || $key === 'pageStart') {
            $this->resetPage();
            $this->selectAll = false;
            $this->checked = [];
        }
    }

    //untuk mereset selectall dan chceked ketika berpindah halaman
    public function updatingPage()
    {
        $this->checked = [];
        $this->selectAll = false;
    }

    public function deleteUsers()
    {
        dd($this->checked);
    }

    public function placeholder()
    {
        return <<<'HTML'
            <div class="absolute z-50 h-full w-4/5 flex items-center justify-center bg-gray-200 bg-opacity-50">
                <svg class="animate-spin h-8 w-8 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
        HTML;
    }

    public function openModal()
    {
        $this->dispatch('openUserForm');
    }

    public function render()
    {

        $users = $this->fetchUsers();

        $roles = Role::all();

        return view('livewire.pages.users', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

}
