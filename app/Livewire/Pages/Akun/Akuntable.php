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
}
