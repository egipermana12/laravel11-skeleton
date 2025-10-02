<div class="py-2">
    <div class="max-w-7xl mx-auto px-2">
        <div wire:loading>
            <div class="absolute z-50 h-full w-4/5 flex items-center justify-center bg-gray-200 bg-opacity-50">
                <svg class="animate-spin h-8 w-8 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex items-center justify-between">
                    <h5 class="font-semibold text-gray-800">Daftar Akun</h5>
                    <button wire:click="$dispatch('akun-add-drawer')"
                        class="bg-gray-900 text-white font-semibold text-sm px-3 py-2 rounded-md hover:bg-gray-700">
                        <i class="fa-solid fa-circle-plus"></i>&nbsp;&nbsp;Add Akun
                    </button>
                </div>

                <livewire:pages.akun.akuntable />

            </div>
        </div>
    </div>
    <livewire:pages.akun.akunadd />
    <livewire:pages.akun.akun-delete />

    {{-- modal add akun --}}
    <x-modalcustom name="user-cari" wire:model.live="modalAddAkun" maxWidth="md">
        <div class="flex items-center justify-between p-4">
            <h5 class="text-sm font-semibold text-gray-900">Tambah Akun</h5>
            <button type="button" wire:click="closeModalAddAkun"
                class="text-gray-400 bg-gray-100 hover:bg-gray-200 hover:text-gray=900 rounded-md text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div class="p-4">
            <form wire:submit.prevent="storeAkun1">
                @csrf
                <div>
                    <div class="flex items-center gap-1 w-full">
                        <div class="">
                            <x-input-label class=" text-xs" for="form.kd_akun1" :value="__('Kode')" />
                            <x-text-input wire:model="form.kd_akun1" id="form.kd_akun1" type="text"
                                class="mt-1 block w-16 text-sm {{ $errors->has('form.kd_akun1') ? 'error-input border-red-500' : '' }} "
                                placeholder="Input kode akun" autocomplete="form.kd_akun1" />
                        </div>
                        <div class="w-full">
                            <x-input-label class=" text-xs" for="form.nama_akun" :value="__('Nama Akun')" />
                            <x-text-input wire:model="form.nama_akun" id="form.nama_akun" type="text"
                                class="mt-1 block w-full text-sm {{ $errors->has('form.nama_akun') ? 'error-input border-red-500' : '' }} "
                                placeholder="Input kode akun" autocomplete="form.nama_akun" />
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.kd_akun1')" />
                        <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.nama_akun')" />
                    </div>
                </div>
                <div>
                    <x-input-label class="text-xs" for="form.nama" :value="__('Jenis Akun')" />
                    <select wire:model="form.jenis_akun" id="form.jenis_akun"
                        class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg w-full {{ $errors->has('form.jenis_akun') ? 'error-input border-red-500' : '' }} ">
                        <option value="" selected></option>
                        <option value="debet">Debet</option>
                        <option value="kredit">Kredit</option>
                    </select>
                    <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.jenis_akun')" />
                </div>
                <div>
                    <x-input-label class="text-xs" for="form.ket" :value="__('Keterangan')" />
                    <x-textarea wire:model="form.ket" id="form.ket" class="mt-1 block w-full text-sm"
                        autocomplete="form.ket"></x-textarea>
                </div>
                <div class="flex items-center justify-end mt-4 p-4">
                    <x-primary-button type="button" wire:click="closeModalAddAkun"
                        class="ms-4 bg-red-500 text-white hover:bg-red-700">
                        {{ __('Batal') }}
                    </x-primary-button>
                    <x-primary-button wire:loading.attr="disable" class="ms-4">
                        {{ __('Simpan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modalcustom>

    {{-- modal edit akun --}}
    <x-modalcustom name="user-cari" wire:model.live="modalEditAkun" maxWidth="md">
        <div class="flex items-center justify-between p-4">
            <h5 class="text-sm font-semibold text-gray-900">Edit Akun</h5>
            <button type="button" wire:click="closeModalEditAkun"
                class="text-gray-400 bg-gray-100 hover:bg-gray-200 hover:text-gray=900 rounded-md text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div class="p-4">
            <form wire:submit.prevent="updateAkun">
                @csrf
                <div>
                    <div class="flex items-center gap-1 w-full">
                        <div class="">
                            <x-input-label class=" text-xs" for="form.kd_akun1" :value="__('KD01')" />
                            <x-text-input wire:model="form.kd_akun1" id="form.kd_akun1" type="text" disabled
                                class="mt-1 bg-gray-100 block w-8 text-sm {{ $errors->has('form.kd_akun1') ? 'error-input border-red-500' : '' }} "
                                placeholder="Input kode akun" autocomplete="form.kd_akun1" />
                        </div>
                        <div>
                            <x-input-label class=" text-xs" for="form.kd_akun3" :value="__('KD02')" />
                            <x-text-input wire:model="form.kd_akun3" id="form.kd_akun3" type="text" disabled
                                class="mt-1 bg-gray-100 block w-16 text-sm {{ $errors->has('form.kd_akun3') ? 'error-input border-red-500' : '' }} "
                                placeholder="Input kode akun" autocomplete="form.kd_akun3" />
                        </div>
                        <div class="w-full">
                            <x-input-label class=" text-xs" for="form.nama_akun" :value="__('Nama Akun')" />
                            <x-text-input wire:model="form.nama_akun" id="form.nama_akun" type="text"
                                class="mt-1 block w-full text-sm {{ $errors->has('form.nama_akun') ? 'error-input border-red-500' : '' }} "
                                placeholder="Input kode akun" autocomplete="form.nama_akun" />
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.nama_akun')" />
                    </div>
                </div>
                <div>
                    <x-input-label class="text-xs" for="form.nama" :value="__('Jenis Akun')" />
                    <select wire:model="form.jenis_akun" id="form.jenis_akun" {{ $disableJnsAkun ? 'disabled' : '' }}
                        class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg w-full {{ $errors->has('form.jenis_akun') ? 'error-input border-red-500' : '' }} ">
                        <option value="" selected>Pilih</option>
                        <option value="debet">Debet</option>
                        <option value="kredit">Kredit</option>
                    </select>
                    <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.jenis_akun')" />
                </div>
                <div>
                    <x-input-label class="text-xs" for="form.ket" :value="__('Keterangan')" />
                    <x-textarea wire:model="form.ket" id="form.ket" class="mt-1 block w-full text-sm"
                        autocomplete="form.ket"></x-textarea>
                </div>
                <div class="flex items-center justify-end mt-4 p-4">
                    <x-primary-button type="button" wire:click="closeModalAddAkun"
                        class="ms-4 bg-red-500 text-white hover:bg-red-700">
                        {{ __('Batal') }}
                    </x-primary-button>
                    <x-primary-button wire:loading.attr="disable" class="ms-4">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modalcustom>
</div>