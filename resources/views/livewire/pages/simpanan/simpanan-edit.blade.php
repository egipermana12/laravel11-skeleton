<div class="py-2">
    <div class="max-w-7xl mx-auto px-2">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
            <div class="p-6 px-4 py-6 space-y-4 text-gray-900 dark:text-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">Tambah Anggota</h2>
                <form wire:submit.prevent="update" class="lg:w-1/2 w-full">
                    @csrf
                    <div class="">
                        <div class="flex gap-x-2 justify-end items-end mb-4">
                            <div class="flex-grow">
                                <x-input-label class="text-xs" for="form.nik" :value="__('NIK Anggota')" />
                                <x-text-input disabled wire:model.live="form.nik" id="form.nik" type="text"
                                    class="bg-gray-100 mt-1 block w-full text-sm {{ $errors->has('form.nik') ? 'error-input border-red-500' : '' }} "
                                    autocomplete="form.nik" />

                            </div>
                            <div class="flex-grow">
                                <x-input-label class="text-xs" for="form.nama" :value="__('Nama Anggota')" />
                                <x-text-input disabled wire:model.live="form.nama" id="form.nama" type="text"
                                    class="bg-gray-100 mt-1 block w-full text-sm {{ $errors->has('form.nama') ? 'error-input border-red-500' : '' }} "
                                    autocomplete="form.nama" />

                            </div>
                            <div class="text-right">

                            </div>
                        </div>
                        <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.nama')" />
                        <div class="mb-4 w-full">
                            <x-input-label class="text-xs" for="form.kd_akun_debet" :value="__('Akun Debet')" />
                            <livewire:components.select-combo wire:model="form.kd_akun_debet"
                                :selectOpsi="$kd_akundebet" :disable="true" textAtas="Pilih Akun" class="w-full" />
                        </div>
                        <div class="mb-4 w-full">
                            <x-input-label class="text-xs" for="form.kd_akun_kredit" :value="__('Akun Debet')" />
                            <livewire:components.select-combo wire:model.change="form.kd_akun_kredit"
                                :selectOpsi="$kd_akunkredit" :disable="true" textAtas="Pilih Akun Kredit"
                                class="w-full  {{ $errors->has('form.kd_akun_kredit') ? 'error-input border-red-500' : '' }}" />
                            <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.kd_akun_kredit')" />
                        </div>
                        <div class="flex gap-x-2 justify-end items-end mb-4">
                            <div class="w-1/2">
                                <x-input-label class="text-xs" for="form.jenis_simpanan"
                                    :value="__('Jenis Simpanan')" />
                                <x-radio-label disabled name="jenis_simpanan" type="radio" id="aktif"
                                    wire:model="form.jenis_simpanan" value="pokok">
                                    Pokok
                                </x-radio-label>
                            </div>
                            <div class="w-1/2">
                                <x-radio-label disabled name="jenis_simpanan" type="radio" id="tidak aktif"
                                    wire:model="form.jenis_simpanan" value="wajib">
                                    Wajib
                                </x-radio-label>
                            </div>
                            <div class="w-1/2">
                                <x-radio-label disabled name="jenis_simpanan" type="radio" id="tidak aktif"
                                    wire:model="form.jenis_simpanan" value="sukarela">
                                    Sukarela
                                </x-radio-label>
                            </div>
                        </div>
                        <x-input-error class="mt-0 text-xs" :messages="$errors->get('form.jenis_simpanan')" />
                        <div class="flex gap-x-2 justify-between items-start mb-4">
                            <div class="flex-grow">
                                <x-input-label class="text-xs" for="form.tgl_simpanan"
                                    :value="__('Tanggal Transaksi')" />
                                <livewire:components.input-tanggal wire:model="form.tgl_simpanan"
                                    class="mt-1 block w-full text-sm {{ $errors->has('form.jumlah') ? 'error-input border-red-500' : '' }}" />
                                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.tgl_simpanan')" />
                            </div>
                            <div class="flex-grow">
                                <x-input-label class="text-xs" for="form.jumlah" :value="__('Jumlah Simpanan')" />
                                <livewire:components.input-rupiah wire:model="form.jumlah"
                                    class="mt-1 block w-full text-sm {{ $errors->has('form.jumlah') ? 'error-input border-red-500' : '' }}" />
                                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.jumlah')" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <x-input-label class="text-xs" for="form.keterangan" :value="__('Keterangan')" />
                            <textarea id="message" rows="4" wire:model="form.keterangan"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."></textarea>

                        </div>
                    </div>
                    {{-- untuk hidden form --}}
                    <x-text-input disabled wire:model="form.id_anggota" id="form.id_anggota" type="text"
                        class="bg-gray-100 mt-1 block w-full text-sm {{ $errors->has('form.id_anggota') ? 'error-input border-red-500' : '' }} "
                        autocomplete="form.id_anggota" />
                    <div class="flex items-center justify-end mt-4 p-4">
                        <a href="{{url('simpanan')}}" wire:navigate>
                            <x-primary-button type="button" class="ms-4 bg-red-500 text-white hover:bg-red-700">
                                {{ __('Batal') }}
                            </x-primary-button>
                        </a>
                        <x-primary-button wire:loading.attr="disable" class="ms-4">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>