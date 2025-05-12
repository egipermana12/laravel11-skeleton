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
                <select wire:model.change="form.jenis_simpanan"
                    class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg">
                    <option value="" selected>Semua Jenis</option>
                    <option value="wajib">Wajib</option>
                    <option value="pokok">Pokok</option>
                    <option value="sukarela">Sukarela</option>
                </select>
                <x-text-input wire:model.live="search"
                    class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 "
                    placeholder="cari NIK / Nama Anggota" autocomplete="off" />
                <x-text-input wire:model.live="tgl_awal" x-ref="tgl_awal" x-init="
                    new pikaday({
                        field: $refs.tgl_awal,
                        format: 'YYYY-MM-DD',
                        toString(date, format) {
                            const day = String(date.getDate()).padStart(2, 0);
                            const month = String(date.getMonth() + 1).padStart(2, 0);
                            const year = date.getFullYear();
                            return `${year}-${month}-${day}`;
                        },
                        onSelect: function() {
                            console.log(moment(this.getDate()).format('YYYY-MM-DD'));
                            $wire.set('tgl_awal', moment(this.getDate()).format('YYYY-MM-DD'));
                        }
                    })"
                    class="w-28 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 "
                    placeholder="tanggal awal" autocomplete="off" />
                <x-text-input wire:model.live="tgl_akhir" x-ref="tgl_akhir" x-init="
                    new pikaday({
                        field: $refs.tgl_akhir,
                        format: 'YYYY-MM-DD',
                        toString(date, format) {
                            const day = String(date.getDate()).padStart(2, 0);
                            const month = String(date.getMonth() + 1).padStart(2, 0);
                            const year = date.getFullYear();
                            return `${year}-${month}-${day}`;
                        },
                        onSelect: function() {
                            console.log(moment(this.getDate()).format('YYYY-MM-DD'));
                            $wire.set('tgl_akhir', moment(this.getDate()).format('YYYY-MM-DD'));
                        }
                    })" class="w-28 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                        focus:border-blue-500 " placeholder="tanggal akhir" autocomplete="off" />
                <button wire:click="clear"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center">Clear</button>
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
            class="table-auto w-full [&>tbody>*:nth-child(odd)]:bg-gray-100 [&>tbody>*:nth-child(even)]:bg-gray-50 text-xs rtl:text-right text-gray-500">
            <thead class="text-xs font-bold text-gray-700  uppercase border-b border-gray-200">
                <tr class="w-full">
                    <th class="px-2 py-4 text-center " width="4%">
                        No</th>
                    <th class="px-2 py-4 text-center " width="2%">
                        <input wire:model.live="selectAll" type="checkbox"
                            class="w-4 h-4 text-center text-blue-600 bg-white border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                    </th>
                    <th class="px-2 py-4 cursor-pointer text-left" width="10%">
                        NIK Anggota
                    </th>
                    <th class="px-2 py-4 cursor-pointer text-left" width="10%">
                        Nama Anggota
                    </th>
                    <th class="px-2 py-4 cursor-pointer text-left" width="10%">
                        Jenis Simpanan
                    </th>
                    <th class="px-2 py-4 cursor-pointer text-left" width="10%">
                        Tanggal
                    </th>
                    <th class="px-2 py-4 cursor-pointer text-right" width="10%">
                        Jumlah
                    </th>
                    <th class="px-2 py-4 text-center" width="8%">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="border-b border-gray-100 text-[13px]" wire.loading.class="opacity-50">
                @foreach($simpanans as $index => $simpanan)
                <tr class="border-b border-gray-100 w-full " wire:key="{{$simpanan->simpanan_id}}">
                    <td class="px-1 py-4 text-center ">{{ $loop->iteration }}</td>
                    <td class="px-1 py-4 text-center ">
                        <input wire:model.live="checked" wire:key="checkbox-{{ $simpanan->simpanan_id }}"
                            type="checkbox" value="{{$simpanan->simpanan_id}}"
                            class="w-4 h-4 text-center text-blue-600 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                    </td>
                    <td class="px-1 py-4">{{ $simpanan->anggota->nik }}</td>
                    <td class="px-1 py-4">{{ $simpanan->anggota->nama }}</td>
                    <td class="px-1 py-4 flex items-center gap-1">
                        @if($simpanan->jenis_simpanan == 'wajib')
                        <span class="bg-indigo-600 w-2 h-2 rounded-full inline-block"></span>
                        {{$simpanan->jenis_simpanan}}
                        @elseif($simpanan->jenis_simpanan == 'pokok')
                        <span class="bg-green-600 w-2 h-2 rounded-full inline-block"></span>
                        {{$simpanan->jenis_simpanan}}
                        @else
                        <span class="bg-yellow-500 w-2 h-2 rounded-full inline-block"></span>
                        {{$simpanan->jenis_simpanan}}
                        @endif
                    </td>
                    <td class="px-1 py-4">{{ $simpanan->tgl_simpanan }}</td>
                    <td class="px-1 py-4 text-right">{{ number_format($simpanan->jumlah,2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $simpanans->onEachSide(1)->links() }}
        </div>
    </div>
</div>