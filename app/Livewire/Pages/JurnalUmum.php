<?php

namespace App\Livewire\Pages;

use App\Livewire\Forms\JurnalUmumForm;
use App\Models\Jurnal;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\JurnalUmumExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Attributes\On;
use Illuminate\Http\Request;

class JurnalUmum extends Component
{
    public JurnalUmumForm $form;

    public $startOfMonth;
    public $endOfMonth;

    private $jurnalumums = null;

    #[On('changeTanggalJurnal')]
    public function getAllParamasChild($startOfMonth, $endOfMonth)
    {
        $this->startOfMonth = $startOfMonth;
        $this->endOfMonth = $endOfMonth;
    }

    public function exportPDF(Request $request)
    {
        $params1 = $request->query('startOfMonth');
        $params2 = $request->query('endOfMonth');

        $start = Carbon::parse($params1)->locale('id')->isoFormat('D MMMM Y');
        $end = Carbon::parse($params2)->locale('id')->isoFormat('D MMMM Y');

        Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif', 'default_paper_orientation' => 'landscape']);
        $pdf = Pdf::loadView('livewire.pages.jurnal-umum.jurnal-umum-pdf', [
            'jurnalumums' => $this->fetchJurnalUmum($params1, $params2),
            'startOfMonth' => $start,
            'endOfMonth' => $end,
        ]);

        return response($pdf->stream('jurnal_umum.pdf'))
            ->header('Content-Type', 'application/pdf');
    }

    public function exportExcel(Request $request)
    {
        $params1 = $request->query('startOfMonth');
        $params2 = $request->query('endOfMonth');
        return Excel::download(new JurnalUmumExport($params1, $params2), 'jurnal_umum.xlsx');
    }

    public function render()
    {
        return view('livewire.pages.jurnal-umum');
    }

    public function fetchJurnalUmum($start, $end)
    {

        if ($this->jurnalumums === null) {
            $query = Jurnal::with('akun')->with('transaksi')
                ->select('jurnal_id', 'tanggal', 'transaksi_id', 'akun_id', 'kd_akun1', 'kd_akun3', 'debet', 'kredit');
            if ($start && $end) {
                $query->whereBetween('tanggal', [$start, $end]);
            }
            $data = $query->orderBy('tanggal')->orderBy('transaksi_id')->get();
            // Group data by tanggal + transaksi_id
            $grouped = $data->groupBy(function ($item) {
                return $item->tanggal . '-' . $item->transaksi_id;
            });
            // Convert to array of groups (for pagination)
            return $grouped;
        }
    }
}
