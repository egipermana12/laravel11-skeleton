<?php

namespace App\Livewire\Pages\Simpanan;

use Livewire\Component;
use App\Traits\WithSorting;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Livewire\Forms\SimpananForm;
use App\Models\Simpanan;

#[Lazy()]
#[On('simpananChanged')]
class Simpanantable extends Component
{
    use WithPagination;
    use WithSorting;

    public SimpananForm $form;

    public $checked = [];
    public $selectAll = false;

    public $sortBy = 'simpanan_id';
    public $sortDirection = 'asc';
    public $pageStart = 10;

    public string $search = '';
    public string $tgl_awal = '';
    public string $tgl_akhir = '';

    private $simpanans = null;

    public function mount()
    {
        $this->form->jenis_simpanan = '';
    }

    private function fetchSimpanans()
    {
        if ($this->simpanans === null) {
            $query = Simpanan::with('anggota')->select('simpanan_id', 'id_anggota', 'jenis_simpanan', 'jumlah', 'tgl_simpanan', 'keterangan');

            if ($this->form->jenis_simpanan != '') {
                $query->where('jenis_simpanan', '=', $this->form->jenis_simpanan);
            }

            //cari simpanan berdasarkan tanggal
            if ($this->tgl_awal != '' && $this->tgl_akhir != '') {
                $query->whereBetween('tgl_simpanan', [$this->tgl_awal, $this->tgl_akhir]);
            }

            //cari anggota berdasarkan nama atau nik
            if ($this->search) {
                $query->whereHas('anggota', function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                        ->orWhere('nik', 'like', '%' . $this->search . '%');
                });
            }
            $this->simpanans = $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->pageStart);
        }
        return $this->simpanans;
    }

    public function clear()
    {
        $this->form->reset();
        $this->reset('checked', 'selectAll');
        $this->search = '';
        $this->tgl_awal = '';
        $this->tgl_akhir = '';
        $this->simpanans = null;
        $this->resetPage();
    }

    public function render()
    {
        $simpanans = $this->fetchSimpanans();
        return view('livewire.pages.simpanan.simpanantable', compact('simpanans'));
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
