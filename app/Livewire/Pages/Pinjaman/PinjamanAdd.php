<?php

namespace App\Livewire\Pages\Pinjaman;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\PinjamanForm as FormsPinjamanForm;

class PinjamanAdd extends Component
{
    public FormsPinjamanForm $form;

    public $modalCariUserPinjaman = false;

    public function mount()
    {
        $this->form->jumlah = 0;
        $this->form->tgl_pinjaman = Carbon::now()->format('Y-m-d');
    }

    private function status_pinjaman()
    {
        $status_pinjaman = collect([
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            'lunas' => 'Lunas',
            'belum_lunas' => 'Belum Lunas',
        ]);
        return $status_pinjaman;
    }

    private function lama_angsuran()
    {
        $lama_angsuran = collect([
            '1' => '1 Bulan',
            '3' => '3 Bulan',
            '6' => '6 Bulan',
            '12' => '12 Bulan',
        ]);
        return $lama_angsuran;
    }

    #[On('carimodaluserpinjaman')]
    public function openModalCariUserPinjaman()
    {
        $this->modalCariUserPinjaman = true;
    }

    public function render()
    {
        $status_pinjaman = $this->status_pinjaman();
        $lama_angsuran = $this->lama_angsuran();
        return view('livewire.pages.pinjaman.pinjaman-add', compact('status_pinjaman', 'lama_angsuran'));
    }
}
