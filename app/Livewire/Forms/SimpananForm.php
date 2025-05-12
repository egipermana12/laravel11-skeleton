<?php

namespace App\Livewire\Forms;

use App\Models\Jurnal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Form;
use App\Models\Simpanan;
use App\Models\Transaksi;
use App\Traits\MappingAkunSimpanan;
use Livewire\Attributes\Locked;
use Illuminate\Validation\Rule;

class SimpananForm extends Form
{
    use MappingAkunSimpanan;

    public ?Simpanan $simpanan;

    #[Locked]
    public $simpanan_id;

    public $id_anggota;

    public $kd_akun_kredit;
    public $jenis_simpanan;
    public $jumlah = 0;
    public $tgl_simpanan;
    public $keterangan;
    public $nama;
    public $nik;


    public $kd_akun_debet;


    public function rules()
    {
        return [
            'id_anggota' => 'required',
            'nama' => 'required',
            'nik' => 'required',
            'kd_akun_debet' => 'required',
            'kd_akun_kredit' => 'required',
            'jenis_simpanan' => ['required', Rule::in(['pokok', 'wajib', 'sukarela']), function ($attribute, $value, $fail) {
                if (!$this->isJenisSimpanan($this->kd_akun_kredit, $value)) {
                    $fail('Jenis simpanan tidak sesuai dengan akun kredit.');
                }
            }],
            'jumlah' => 'required|numeric|min:1',
            'tgl_simpanan' => 'required',
            'keterangan' => 'nullable|string',
        ];
    }

    public function setSimpanan(Simpanan $simpanan)
    {
        $this->simpanan = $simpanan;
        $this->simpanan_id = $simpanan->simpanan_id;
        $this->id_anggota = $simpanan->id_anggota;
        $this->jenis_simpanan = $simpanan->jenis_simpanan;
        $this->jumlah = $simpanan->jumlah;
        $this->tgl_simpanan = $simpanan->tgl_simpanan;
        $this->keterangan = $simpanan->keterangan;
    }

    public function store(): bool
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $simpanan = Simpanan::create([
                'id_anggota' => $this->id_anggota,
                'jenis_simpanan' => $this->jenis_simpanan,
                'jumlah' => $this->jumlah,
                'tgl_simpanan' => $this->tgl_simpanan,
                'keterangan' => $this->keterangan,
            ]);
            $transaksi = Transaksi::create([
                'refid_transaksi' => $simpanan->simpanan_id,
                'tanggal' => $this->tgl_simpanan,
                'jenis_transaksi' => 'simpanan',
                'keterangan' => 'Simpanan ' . $this->jenis_simpanan,
            ]);

            Jurnal::create([
                'tanggal' => $this->tgl_simpanan,
                'transaksi_id' => $transaksi->transaksi_id,
                'akun_id' =>  substr($this->kd_akun_debet, 0, 1),
                'kd_akun1' => substr($this->kd_akun_debet, 2, 1),
                'kd_akun2' => substr($this->kd_akun_debet, 4, 1),
                'kd_akun3' => substr($this->kd_akun_debet, 6, 2),
                'debet' => $this->jumlah,
                'kredit' => 0,
            ]);
            Jurnal::create([
                'tanggal' => $this->tgl_simpanan,
                'transaksi_id' => $transaksi->transaksi_id,
                'akun_id' =>  substr($this->kd_akun_kredit, 0, 1),
                'kd_akun1' => substr($this->kd_akun_kredit, 2, 1),
                'kd_akun2' => substr($this->kd_akun_kredit, 4, 1),
                'kd_akun3' => substr($this->kd_akun_kredit, 6, 2),
                'kredit' => $this->jumlah,
                'debet' => 0,
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log jika ada kesalahan
            Log::error('Gagal menyimpan data simpanan: ' . $e->getMessage());
            Log::channel('simpanan')->error('Gagal menyimpan data simpanan: ' . $e->getMessage());
            return false;
        }
    }
}
