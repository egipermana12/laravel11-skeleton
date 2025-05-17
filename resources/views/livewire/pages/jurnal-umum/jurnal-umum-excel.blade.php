<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Transaksi</th>
            <th>Kode Akun</th>
            <th>Debet</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        @if($jurnalumums->isEmpty())
        <tr>
            <td colspan="6" class="text-center">Tidak ada data</td>
        </tr>
        @else
        @foreach ($jurnalumums as $groupIndex => $items)
        @php
        $isOdd = ($loop->iteration % 2) === 1;
        $rowClass = $isOdd ? 'bg-gray-100' : 'bg-gray-50';
        @endphp
        @foreach ($items as $index => $item)
        <tr class="{{ $rowClass }}">
            @if($index === 0)
            <td rowspan="{{ $items->count() }}" class="px-2 py-4 text-center">{{ $loop->parent->iteration }}</td>
            <td rowspan="{{ $items->count() }}" class="px-2 py-4">{{ $item->tanggal }}</td>
            <td rowspan="{{ $items->count() }}" class="px-2 py-4">{{
                $item->transaksi->jenis_transaksi }}</td>
            @endif
            <td class="px-2 py-4">{{ $item->kd_akun1 .'.'. $item->kd_akun3 . '.' }} {{$item->akun->nama_akun}}</td>
            <td class="px-2 py-4">{{ $item->debet }}</td>
            <td class="px-2 py-4">{{ $item->kredit }}</td>
        </tr>
        @endforeach
        @endforeach
        @endif
    </tbody>
</table>