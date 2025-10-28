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
        {{-- untuk filter --}}
        <div class="my-2 flex items-center justify-between">

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
                        Tanggal
                    </th>
                    <th class="px-2 py-4 cursor-pointer text-left" width="8%">
                        Status
                    </th>
                    <th class="px-2 py-4 cursor-pointer text-right" width="12%">
                        Jumlah Pinjaman
                    </th>
                    <th class="px-2 py-4 cursor-pointer text-right" width="10%">
                        Lama Angsuran (Bulan)
                    </th>
                    <th class="px-2 py-4 text-center" width="8%">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="border-b border-gray-100 text-[13px]" wire.loading.class="opacity-50">
                @foreach($pinjamans as $index => $pinjaman)
                <tr class="border-b border-gray-100 w-full " wire:key="{{$pinjaman->pinjaman_id}}">
                    <td class="px-1 py-4 text-center ">{{ $loop->iteration }}</td>
                    <td class="px-1 py-4 text-center ">
                        <input wire:model.live="checked" wire:key="checkbox-{{ $pinjaman->pinjaman_id }}"
                            type="checkbox" value="{{$pinjaman->pinjaman_id}}"
                            class="w-4 h-4 text-center text-blue-600 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                    </td>
                    <td class="px-1 py-4">{{ $pinjaman->anggota->nik }}</td>
                    <td class="px-1 py-4">{{ $pinjaman->anggota->nama }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $pinjamans->onEachSide(1)->links() }}
        </div>
    </div>
</div>