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
                <livewire:components.input-tanggal wire:model.live="startOfMonth" class="mt-1 block w-full text-sm" />
                <livewire:components.input-tanggal wire:model.live="endOfMonth" class="mt-1 block w-full text-sm" />
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
    </div>
    <table class="table-auto w-full" text-left text-sm rtl:text-right text-gray-500">
        <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
            <tr class="">
                <th class="px-2 py-4 text-center" width="4%">No</th>
                <th class="px-2 py-4 cursor-pointer" width="15%">
                    Tanggal
                </th>
                <th class="px-2 py-4 cursor-pointer" width="15%">
                    Transaksi
                </th>
                <th class="px-2 py-4 cursor-pointer" width="15%">
                    Kode Akun
                </th>
                <th class="px-2 py-4 cursor-pointer" width="15%">
                    Debet
                </th>
                <th class="px-2 py-4 cursor-pointer" width="15%">
                    Kredit
                </th>
            </tr>
        </thead>
        <tbody class="text-sm" wire.loading.class="opacity-50">
            @foreach ($jurnalumums as $group => $items)
            @php
            $isOdd = $loop->iteration % 2 === 1;
            $rowClass = $isOdd ? 'bg-gray-100' : 'bg-gray-50';
            @endphp
            @foreach ($items as $index => $item)
            <tr class="border border-gray-200 {{$rowClass}}">
                @if($index === 0)
                <td rowspan="{{ $items->count() }}" class="px-2 py-4 text-center border border-gray-200">{{
                    $loop->parent->iteration }}</td>
                <td rowspan="{{ $items->count() }}" class="px-2 py-4 border border-gray-200">{{ $item->tanggal }}</td>
                <td rowspan="{{ $items->count() }}" class="px-2 py-4 border border-gray-200">{{
                    $item->transaksi->jenis_transaksi }}
                </td>
                @endif
                <td class="px-2 py-4 border border-gray-200">
                    {{ $item->kd_akun1 .'.'. $item->kd_akun3 . '.' }} {{$item->akun->nama_akun}}
                </td>
                <td class="px-2 py-4 border border-gray-200 text-right">{{ number_format($item->debet, 0, ',', '.') }}
                </td>
                <td class="px-2 py-4 border border-gray-200 text-right">{{ number_format($item->kredit, 0, ',', '.') }}
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    {{-- Paginate Links --}}
    <div class="mt-4">
        {{ $jurnalumums->links() }}
    </div>
</div>