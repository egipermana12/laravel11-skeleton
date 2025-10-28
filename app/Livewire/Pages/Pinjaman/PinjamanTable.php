<?php

namespace App\Livewire\Pages\Pinjaman;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Livewire\Forms\PinjamanForm;
use App\Models\Pinjaman;

#[Lazy()]
#[On('pinjamanChanged')]
class PinjamanTable extends Component
{

    //inisiasi awal pinjaman
    public $sortBy = 'pinjaman_id';
    public $sortDirection = 'asc';
    public $pageStart = 10;
    private $pinjamans = null;

    //fetch pinjaman
    private function fetchPinjamans()
    {
        if ($this->pinjamans === null) {
            $this->pinjamans = Pinjaman::with('anggota')->select('pinjaman_id', 'id_anggota', 'jumlah', 'tgl_pinjaman', 'status', 'lama_angsuran', 'keterangan');
            $this->pinjamans = $this->pinjamans->orderBy($this->sortBy, $this->sortDirection)->paginate($this->pageStart);
        }
        return $this->pinjamans;
    }

    public function render()
    {
        $pinjamans = $this->fetchPinjamans();
        return view('livewire.pages.pinjaman.pinjaman-table', compact('pinjamans'));
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
