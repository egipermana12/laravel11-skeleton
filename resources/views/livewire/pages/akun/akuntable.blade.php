<div class="mt-6 pb-12">
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
    <div class="text-gray-900 dark:text-gray-100">
        <div class="my-2 flex items-center justify-between">
            <div class="flex items-center justify-normal gap-x-2">
                <select wire:model.change="form.kd_akun1"
                    class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg">
                    <option value="" selected>Semua Akun</option>
                    @foreach($kd_akun1 as $akun)
                    <option value="{{ $akun->kd_akun1 }}">{{ $akun->kd_akun1 }} - {{ $akun->nama_akun }}</option>
                    @endforeach
                </select>
                <select wire:model.change="form.jenis_akun"
                    class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg">
                    <option value="" selected>Semua Jenis</option>
                    <option value="debet">Debet</option>
                    <option value="kredit">Kredit</option>
                </select>
                <x-text-input wire:model.live="form.nama_akun" type="text" id="form.nama_akun"
                    class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    placeholder="cari nama akun" autocomplete="off" />
            </div>

            <div class="flex items-center justify-between gap-x-2">
                <select wire:model.live="pageStart"
                    class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        {{-- table --}}
        <table class="table-auto w-full text-left text-sm rtl:text-right text-gray-500">
            <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-2 py-4 text-center" width="4%">No</th>
                    <th class="px-2 py-4 text-center" width="4%">
                        <input wire:model.live="selectAll" type="checkbox"
                            class="w-4 h-4 text-center text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                    </th>
                    <th class="px-2 py-4 cursor-pointer" width="8%">
                        Kode Akun
                    </th>
                    <th class="px-2 py-4 cursor-pointer" width="20%">
                        Nama Akun
                    </th>
                    <th class="px-2 py-4 cursor-pointer" width="10%">
                        Jenis Akun
                    </th>
                    <th class="px-2 py-4 cursor-pointer" width="20%">
                        Keterangan
                    </th>
                    <th class="px-2 py-4 text-center" width="8%">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-b border-gray-100 text-sm" wire.loading.class="opacity-50">
                @foreach($akuns as $index => $akun)
                @php
                if($akun->kd_akun2 == '0' && $akun->kd_akun3 == '00'){
                $class = 'font-bold text-black bg-gray-100';
                }else{
                $class = '';
                }
                @endphp
                <tr class="border-b border-gray-100 " wire:key="{{$akun->akun_id}}">
                    <td class="px-2 py-4 text-center {{$class}}">{{ $loop->iteration }}</td>
                    <td class="px-2 py-4 text-center {{$class}}">
                        <input wire:model.live="checked" wire:key="checkbox-{{ $akun->akun_id }}" type="checkbox"
                            value="{{$akun->akun_id}}"
                            class="w-4 h-4 text-center text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                    </td>
                    <td class="px-2 py-4 {{$class}}">{{ $akun->kd_akun1 . $akun->kd_akun3 }}</td>
                    <td class="px-2 py-4 {{$class}}">
                        {{ $akun->nama_akun }}
                    </td>
                    <td class="px-2 py-4 {{$class}}">{{ $akun->jenis_akun }}</td>
                    <td class="px-2 py-4 {{$class}}">{{ $akun->ket }}</td>
                    <td class="relative px-2 py-4 text-center {{$class}}" x-data="{openAksi : false}">
                        <span @click="openAksi = !openAksi"
                            class="cursor-pointer bg-gray-50 border border-gray-200 p-2 rounded-md text-center hover:bg-gray-100 hover:border-gray-300">
                            <i class="fa-solid fa-ellipsis"></i>
                        </span>
                        <div x-show="openAksi" @click.outside="openAksi = false"
                            class="absolute top-10 right-4 bg-white rounded-md z-50 w-36 border border-gray-200 p-2 text-sm shadow-md">
                            <div class="flex items-start flex-col gap-y-2">
                                <button wire:click="$dispatch('modal-edit-akun', {id: {{$akun->akun_id}} })"
                                    class="py-1 text-gray-600 text-sx w-full flex gap-x-3 hover:text-blue-500">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </button>
                                <button wire:click="$dispatch('akun-delete', {akun_id: {{$akun->akun_id}} })"
                                    class="py-1 text-gray-600 text-sx w-full flex gap-x-3 hover:text-red-500">
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $akuns->onEachSide(1)->links() }}
        </div>
    </div>
</div>