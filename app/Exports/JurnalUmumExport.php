<?php

namespace App\Exports;

use App\Models\Jurnal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class JurnalUmumExport implements FromView
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Jurnal::with('akun')->with('transaksi')
            ->select('jurnal_id', 'tanggal', 'transaksi_id', 'akun_id', 'kd_akun1', 'kd_akun3', 'debet', 'kredit');
        if ($this->start && $this->end) {
            $query->whereBetween('tanggal', [$this->start, $this->end]);
        }
        $data = $query->orderBy('tanggal')->orderBy('transaksi_id')->get();
        $grouped = $data->groupBy(function ($item) {
            return $item->tanggal . '-' . $item->transaksi_id;
        });
        return $grouped;
    }
    public function view(): View
    {
        return view('livewire.pages.jurnal-umum.jurnal-umum-excel', [
            'jurnalumums' => $this->collection()
        ]);
    }
}
