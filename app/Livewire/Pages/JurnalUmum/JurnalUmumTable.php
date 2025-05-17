<?php

namespace App\Livewire\Pages\JurnalUmum;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Livewire\Forms\JurnalUmumForm;
use App\Models\Jurnal;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

#[Lazy()]
class JurnalUmumTable extends Component
{
    use WithPagination;

    public JurnalUmumForm $form;

    public $pageStart = 10;
    public $startOfMonth;
    public $endOfMonth;

    private $jurnalumums = null;
    public function mount()
    {
        $this->startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');
        $this->dispatch('changeTanggalJurnal', $this->startOfMonth, $this->endOfMonth);
    }

    public function updatedStartOfMonth()
    {
        $this->resetPage();
    }

    public function updatedEndOfMonth()
    {
        $this->resetPage();
    }

    public function tampilkan()
    {
        $this->jurnalumums = null;
        $this->resetPage();
        $this->dispatch('changeTanggalJurnal', $this->startOfMonth, $this->endOfMonth);
    }

    public function fetchJurnalUmum()
    {
        if ($this->jurnalumums === null) {
            $query = Jurnal::with('akun')->with('transaksi')
                ->select('jurnal_id', 'tanggal', 'transaksi_id', 'akun_id', 'kd_akun1', 'kd_akun3', 'debet', 'kredit');

            if ($this->startOfMonth && $this->endOfMonth != '') {
                $query->whereBetween('tanggal', [$this->startOfMonth, $this->endOfMonth]);
            }

            $data = $query->orderBy('tanggal')->orderBy('transaksi_id')->get();

            // Group data by tanggal + transaksi_id
            $grouped = $data->groupBy(function ($item) {
                return $item->tanggal . '-' . $item->transaksi_id;
            });

            // Convert to array of groups (for pagination)
            $groupedArray = $grouped->values();

            // Manual pagination
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = $this->pageStart ?? 10;
            $currentPageItems = $groupedArray->slice(($currentPage - 1) * $perPage, $perPage)->values();

            $this->jurnalumums = new LengthAwarePaginator(
                $currentPageItems,
                $groupedArray->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

        return $this->jurnalumums;
    }

    public function render()
    {
        $jurnalumums = $this->fetchJurnalUmum();
        return view('livewire.pages.jurnal-umum.jurnal-umum-table', compact('jurnalumums'));
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
