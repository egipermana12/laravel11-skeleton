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
        {{-- untuk ambil data anggota di component lain --}}
        @if($showButton)
        <div class="text-right">
            <x-primary-button type="button" wire:click="AmbilAnggota" wire:loading.attr="disable"
                class="ms-4 bg-black-500 text-white hover:bg-gray-700">
                {{ __('PIlih') }}
            </x-primary-button>
        </div>
        @endif
        {{-- --}}
        <div class="my-2 flex items-center justify-between">
            <div class="flex items-center justify-normal gap-x-2">
                <x-text-input wire:model.live="form.nik" type="text" id="form.nik"
                    class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    placeholder="cari nik anggota" autocomplete="off" />
                <x-text-input wire:model.live="form.nama" type="text" id="form.nama"
                    class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                    placeholder="cari nama anggota" autocomplete="off" />
                <select wire:model.change="form.status"
                    class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg">
                    <option value="" selected>Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="tidak akfit">Tidak Aktif</option>
                </select>
                <select wire:model.change="form.jenis_kelamin"
                    class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg">
                    <option value="" selected>Semua Gender</option>
                    <option value="L">Pria</option>
                    <option value="P">Wanita</option>
                </select>
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
        <table
            class="table-auto w-full [&>tbody>*:nth-child(odd)]:bg-gray-100 [&>tbody>*:nth-child(even)]:bg-gray-50 text-left text-sm rtl:text-right text-gray-500">
            <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-2 py-4 text-center" width="4%">No</th>
                    <th class="px-2 py-4 text-center" width="4%">
                        <input wire:model.live="selectAll" type="checkbox"
                            class="w-4 h-4 text-center text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                    </th>
                    <th wire:click="sortField('nik')" class="px-2 py-4 cursor-pointer" width="15%">
                        <x-sort sortDirection="{{$sortDirection}}" /> NIK
                    </th>
                    <th wire:click="sortField('nama')" class="px-2 py-4 cursor-pointer" width="20%">
                        <x-sort sortDirection="{{$sortDirection}}" /> Nama
                    </th>
                    <th class="px-2 py-4 cursor-pointer" width="28%">
                        Alamat
                    </th>
                    <th wire:click="sortField('jenis_kelamin')" class="px-2 py-4 cursor-pointer" width="10%">
                        <x-sort sortDirection="{{$sortDirection}}" /> Gender
                    </th>
                    <th wire:click="sortField('status')" class="px-2 py-4 cursor-pointer" width="12%">
                        <x-sort sortDirection="{{$sortDirection}}" /> Status
                    </th>
                    <th class="px-2 py-4 text-center" width="8%">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-b border-gray-100 text-sm" wire.loading.class="opacity-50">
                @foreach($anggotas as $index => $anggota)
                <tr class="border-b border-gray-100 " wire:key="{{$anggota->id}}">
                    <td class="px-2 py-4 text-center">{{ $loop->iteration }}</td>
                    <td class="px-2 py-4 text-center">
                        <input wire:model.live="checked" wire:key="checkbox-{{ $anggota->id }}" type="checkbox"
                            value="{{$anggota->id}}"
                            class="w-4 h-4 text-center text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                    </td>
                    <td class="px-2 py-4">{{$anggota->nik}}</td>
                    <td class="px-2 py-4">{{ $anggota->nama }}</td>
                    <td class="px-2 py-4">{{ $anggota->alamat }}</td>
                    <td class="px-2 py-4">{{ $anggota->jenis_kelamin == 'L' ? 'Pria' : 'Wanita' }}</td>
                    <td class="px-2 py-4">
                        @if($anggota->status == 'aktif')
                        <span
                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Aktif</span>
                        @else
                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Tidak
                            Aktif</span>
                        @endif
                    </td>
                    @if($showButton)
                    <td class="px-2 py-4">
                        <x-primary-button
                            wire:click="$dispatch('pilihanggota-simpanan', {anggota_id: {{$anggota->id}}, nik: {{$anggota->nik}},nama: '{{$anggota->nama}}' })"
                            type="button" wire:loading.attr="disable"
                            class="ms-4 bg-black-500 text-white hover:bg-gray-700">
                            {{ __('PIlih') }}
                        </x-primary-button>
                    </td>
                    @else
                    <td class="relative px-2 py-4 text-center" x-data="{openAksi : false}">
                        <span @click="openAksi = !openAksi"
                            class="cursor-pointer bg-gray-50 border border-gray-200 p-2 rounded-md text-center hover:bg-gray-100 hover:border-gray-300">
                            <i class="fa-solid fa-ellipsis"></i>
                        </span>
                        <div x-show="openAksi" @click.outside="openAksi = false"
                            class="absolute top-10 right-4 bg-white rounded-md z-50 w-36 border border-gray-200 p-2 text-sm shadow-md">
                            <div class="flex items-start flex-col gap-y-2">
                                <button wire:click="$dispatch('anggota-edit-drawer', {id: {{$anggota->id}} })"
                                    class="py-1 text-gray-600 text-sx w-full flex gap-x-3 hover:text-blue-500">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </button>
                                <button
                                    wire:click="$dispatch('anggota-delete', {id: {{$anggota->id}}, nama: '{{$anggota->nama}}' })"
                                    class="py-1 text-gray-600 text-sx w-full flex gap-x-3 hover:text-red-500">
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $anggotas->onEachSide(1)->links() }}
        </div>
    </div>
</div>