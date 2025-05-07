<?php

namespace App\Livewire\Pages\Akun;

use App\Livewire\Forms\AkunForm;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Akun;
use App\Traits\WithSorting;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;

#[Lazy()]
#[On('akunChanged')]
class Akuntable extends Component
{
    use WithPagination;
    use WithSorting;

    public AkunForm $form;

    public $checked = [];
    public $selectAll = false;

    public $sortBy1 = 'kd_akun1';
    public $sortBy2 = 'kd_akun2';
    public $sortBy3 = 'kd_akun3';
    public $sortDirection = 'asc';
    public $pageStart = 10;

    private $akuns = null;

    public function fetchAkun()
    {
        if ($this->akuns == null) {
            $query = Akun::select('akun_id', 'kd_akun1', 'kd_akun2', 'kd_akun3', 'nama_akun', 'jenis_akun', 'ket')
                ->where('nama_akun', 'like', '%' . $this->form->nama_akun . '%');
            if ($this->form->kd_akun1 !== '') {
                $query->where('kd_akun1', '=', $this->form->kd_akun1);
            }
            if ($this->form->jenis_akun !== '') {
                $query->where('jenis_akun', '=', $this->form->jenis_akun);
            }
            $this->akuns = $query->orderBy($this->sortBy1, $this->sortDirection)
                ->orderBy($this->sortBy2, $this->sortDirection)
                ->orderBy($this->sortBy3, $this->sortDirection)
                ->paginate($this->pageStart);
        }
        return $this->akuns;
    }

    public function selectAkun()
    {
        $query = Akun::select('kd_akun1', 'nama_akun');
        $akuns = $query->orderBy('kd_akun1', 'asc')
            ->where('kd_akun2', '0')
            ->where('kd_akun3', '00')
            ->orderBy('nama_akun', 'asc')
            ->get();
        return $akuns;
    }

    public function render()
    {
        $kd_akun1 = $this->selectAkun();
        $akuns = $this->fetchAkun();
        return view('livewire.pages.akun.akuntable', compact('akuns', 'kd_akun1'));
    }

    public function placeholder()
    {
        return <<<'HTML'
            <div class="w-full z-50 h-full w-4/5 flex items-center justify-center bg-gray-200 bg-opacity-50">
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
}
