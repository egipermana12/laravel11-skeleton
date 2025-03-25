<?php

namespace App\Livewire\Pages\Anggota;

use App\Livewire\Forms\AnggotaForm;
use App\Models\Anggota;
use App\Traits\WithSorting;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
#[On('anggotaChanged')]
class AnggotaTable extends Component
{

    use WithPagination;
    use WithSorting;

    public AnggotaForm $form;

    public $checked = [];
    public $selectAll = false;

    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $pageStart = 10;

    private $anggotas = null;

    public function mount()
    {
        $this->form->status = '';
        $this->form->jenis_kelamin = '';
    }

    public function fetchAnggotas()
    {
        if ($this->anggotas === null) {
            $query = Anggota::select('id', 'nik', 'nama','status', 'jenis_kelamin', 'alamat', 'no_telp')
                    ->where('nik', 'like', '%'.$this->form->nik.'%')
                    ->where('nama', 'like', '%'.$this->form->nama.'%')
                    ;
                    if ($this->form->status !== '') {
                        $query->where('status', '=', $this->form->status);
                    }
                    
                    if ($this->form->jenis_kelamin !== '') {
                        $query->where('jenis_kelamin', '=', $this->form->jenis_kelamin);
                    }
            $this->anggotas = $query->orderBy($this->sortBy, $this->sortDirection)->paginate($this->pageStart);
        }
        return $this->anggotas;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->checked = $this->fetchAnggotas()->pluck('id')->map(fn ($item) => (string) $item)->toArray();
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

    public function render()
    {
        $anggotas = $this->fetchAnggotas();
        return view('livewire.pages.anggota.anggota-table', compact('anggotas'));
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
