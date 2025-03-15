<x-drawer maxWidth="xl" name="add-anggota" title="add-anggota" wire:model.live="addDrawerOpen">
    <form wire:submit.prevent="store" class="py-4">
        @csrf
        <div class="p-4 flex items-center justify-between border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Tambah Anggota</h2>
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
                <x-input-label class="text-xs" for="form.nik" :value="__('NIK Anggota')" />
                <x-text-input wire:model="form.nik" id="form.nik" type="text" maxlength="16"
                    oninput="this.value = this.value.replace(/\D/g, '')"
                    class="mt-1 block w-full text-sm {{ $errors->has('form.nik') ? 'error-input border-red-500' : '' }} "
                    placeholder="3272xxxxxxxxxxxx" autocomplete="form.nik" />
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.nik')" />
            </div>
            <div>
                <x-input-label class="text-xs" for="form.nama" :value="__('Nama Anggota')" />
                <x-text-input wire:model="form.nama" id="form.nama" type="text"
                    class="mt-1 block w-full text-sm {{ $errors->has('form.nama') ? 'error-input border-red-500' : '' }} "
                    autocomplete="form.nama" />
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.nama')" />
            </div>
            <div>
                <x-input-label class="text-xs" for="form.jenis_kelamin" :value="__('Jenis Kelamin')" />
                <div class="flex items-start gap-2 w-full mt-1">
                    <x-radio-label name="jenis_kelamin" type="radio" id="L" wire:model="form.jenis_kelamin" value="L">
                        Laki - Laki
                    </x-radio-label>
                    <x-radio-label name="jenis_kelamin" type="radio" id="P" wire:model="form.jenis_kelamin" value="P">
                        Perempuan
                    </x-radio-label>
                </div>
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.jenis_kelamin')" />
            </div>
            <div>
                <x-input-label class="text-xs" for="form.tgl_lahir" :value="__('Tanggal Lahir Anggota')" />
                <x-text-input x-ref="datepicker" x-init="
                        new pikaday({
                            field: $refs.datepicker,
                            format: 'YYYY-MM-DD',
                            toString(date, format) {
                                const day = String(date.getDate()).padStart(2, 0);
                                const month = String(date.getMonth() + 1).padStart(2, 0);
                                const year = date.getFullYear();
                                return `${year}-${month}-${day}`;
                            },
                            yearRange: [1990, 2019],
                            onSelect: function() {
                                console.log(moment(this.getDate()).format('YYYY-MM-DD'));
                                $wire.set('form.tgl_lahir', moment(this.getDate()).format('YYYY-MM-DD'));
                            }
                        })
                    " wire:model="form.tgl_lahir" id="datepicker" type="text"
                    class="mt-1 block w-full text-sm {{ $errors->has('form.tgl_lahir') ? 'error-input border-red-500' : '' }} "
                    autocomplete="form.tgl_lahir" />
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.tgl_lahir')" />
            </div>
            <div>
                <x-input-label class="text-xs" for="form.alamat" :value="__('Alamat Anggota')" />
                <x-textarea wire:model="form.alamat" id="form.alamat" class="mt-1 block w-full text-sm"
                    autocomplete="form.alamat"></x-textarea>
            </div>
            <div>
                <x-input-label class="text-xs" for="form.status" :value="__('Status Keanggotaan')" />
                <div class="flex items-start gap-2 w-full mt-1">
                    <x-radio-label name="status" type="radio" id="aktif" wire:model="form.status" value="aktif">
                        Aktif
                    </x-radio-label>
                    <x-radio-label name="status" type="radio" id="tidak aktif" wire:model="form.status"
                        value="tidak aktif">
                        Tidak
                    </x-radio-label>
                </div>
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.status')" />
            </div>
            <div>
                <x-input-label class="text-xs" for="form.tgl_gabung" :value="__('Tanggal Gabung Anggota')" />
                <x-text-input x-ref="tglgabung" x-init="
                        new pikaday({
                            field: $refs.tglgabung,
                            format: 'YYYY-MM-DD',
                            toString(date, format) {
                                const day = String(date.getDate()).padStart(2, 0);
                                const month = String(date.getMonth() + 1).padStart(2, 0);
                                const year = date.getFullYear();
                                return `${year}-${month}-${day}`;
                            },
                            onSelect: function() {
                                console.log(moment(this.getDate()).format('YYYY-MM-DD'));
                                $wire.set('form.tgl_gabung', moment(this.getDate()).format('YYYY-MM-DD'));
                            }
                        })
                    " wire:model="form.tgl_gabung" id="tglgabung" type="text"
                    class="mt-1 block w-full text-sm {{ $errors->has('form.tgl_gabung')? 'error-input border-red-500' : '' }} "
                    autocomplete="form.tgl_gabung" />
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.tgl_gabung')" />
            </div>
            <div>
                <x-input-label class="text-xs mb-1" for="form.path_image" :value="__('Image')" />
                <div class="p-2 border-2 border-gray-300 border-dashed bg-gray-100 rounded-sm">
                    <input wire:model="form.path_image" id="form.path_image" type="file"
                        class="relative mt-1 pb-4 block w-full text-xs file:absolute file:right-0 file:bg-gray-800 file:text-white file:rounded-md file:hover:bg-gray-900 cursor-pointer file:border-0 file:px-2 file:py-1 file:text-xs file:font-medium file:hover:text-gray-300"
                        autocomplete="form.path_image" />
                    <div class="text-xs text-gray-500">
                        @if($form->path_image)
                        <img src="{{ $form->path_image->temporaryUrl() }}" alt="Image" class="w-full">
                        @endif
                    </div>
                </div>
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.path_image')" />
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
        </div>
    </form>
</x-drawer>