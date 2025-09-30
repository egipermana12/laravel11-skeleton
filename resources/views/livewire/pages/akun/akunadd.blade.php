<x-drawer maxWidth="xl" name="add-akun" title="add-akun" wire:model.live="addDrawerOpen">
    <form wire:submit.prevent="store" class="py-4">
        @csrf
        <div class="p-4 flex items-center justify-between border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Tambah Akun</h2>
            <button type="button" wire:click="closeAddDrawer"
                class="text-gray-400 bg-gray-100 hover:bg-gray-200 hover:text-gray=900 rounded-md text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div class="px-4 py-6 space-y-4">
            <div>
                <x-input-label class="text-xs" for="form.kd_akun1" :value="__('Pilih Akun 1')" />
                <div class="flex items-center justify-between gap-2">
                    <livewire:components.select-akun wire:model.live="form.kd_akun1"
                        class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg w-full  {{ $errors->has('form.kd_akun1') ? 'error-input border-red-500' : '' }}" />
                    <x-primary-button wire:click="$dispatch('akun-add-modal')" type="button"
                        class="ms-4 bg-black-500 text-white hover:bg-black-700">
                        {{ __('Add') }}
                    </x-primary-button>
                </div>
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.kd_akun1')" />
            </div>

            <div>
                <div class="flex items-center gap-1 w-full">
                    <div class="">
                        <x-input-label class=" text-xs" for="form.kd_akun3" :value="__('Kode')" />
                        <x-text-input wire:model="form.kd_akun3" id="form.kd_akun3" type="text"
                            class="mt-1 block w-16 text-sm {{ $errors->has('form.kd_akun3') ? 'error-input border-red-500' : '' }} "
                            placeholder="Input kode akun" autocomplete="form.kd_akun3" />
                    </div>
                    <div class="w-full">
                        <x-input-label class=" text-xs" for="form.nama_akun" :value="__('Nama Akun 2')" />
                        <x-text-input wire:model="form.nama_akun" id="form.nama_akun" type="text"
                            class="mt-1 block w-full text-sm {{ $errors->has('form.nama_akun') ? 'error-input border-red-500' : '' }} "
                            placeholder="Input kode akun" autocomplete="form.nama_akun" />
                    </div>
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </div>
                <div class="flex gap-2">
                    <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.kd_akun3')" />
                    <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.nama_akun')" />
                </div>
            </div>
            <div>
                <x-input-label class="text-xs" for="form.jenis_akun" :value="__('Jenis Akun')" />
                <div class="flex items-center gap-1 w-full">
                    <x-text-input wire:model.live="form.jenis_akun" id="form.jenis_akun" type="text" disabled
                        class="w-full bg-gray-100 mt-1 block text-sm {{ $errors->has('form.jenis_akun') ? 'error-input border-red-500' : '' }} "
                        placeholder="Input kode akun" autocomplete="form.jenis_akun" />
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </div>
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.jenis_akun')" />
            </div>
            <div>
                <x-input-label class="text-xs" for="form.ket" :value="__('Keterangan')" />
                <x-textarea wire:model="form.ket" id="form.ket" class="mt-1 block w-full text-sm"
                    autocomplete="form.ket"></x-textarea>
            </div>
        </div>
        <div class="flex items-center justify-end mt-4 p-4">
            <x-primary-button type="button" wire:click="closeAddDrawer"
                class="ms-4 bg-red-500 text-white hover:bg-red-700">
                {{ __('Batal') }}
            </x-primary-button>
            <x-primary-button wire:loading.attr="disable" class="ms-4">
                {{ __('Simpan') }}
            </x-primary-button>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
    </form>
</x-drawer>