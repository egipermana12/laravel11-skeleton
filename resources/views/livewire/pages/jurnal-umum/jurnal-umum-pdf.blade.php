<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @page {
            size: A4;
            margin: 10mm 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
        }

        header {
            text-align: center;
            margin-bottom: 10px;
        }

        .identitas h3 {
            margin: 0;
            font-size: 14px;
        }

        .identitas h5 {
            margin: 2px 0;
            font-weight: normal;
            font-size: 12px;
        }

        .judul {
            margin-top: 8px;
            font-size: 14px;
            text-transform: uppercase;
        }

        .periode {
            margin-top: 4px;
            font-size: 8px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
            text-align: center;
        }

        tr:nth-child(odd) {
            background-color: #fcfcfc;
        }
    </style>

<body>
    <header>
        <div class="identitas">
            <h3>KOPERASI SIMPAN PINJAM SEJAHTERA BERSAMA</h3>
            <h5>Jl. Raya Sukabumi No. 123, Kota Sukabumi</h5>
            <h5>Telepon: (123) 456-7890</h5>
        </div>
        <div class="judul">Jurnal Umum</div>
        <div class="periode">Periode: {{ $startOfMonth }} - {{ $endOfMonth }}</div>
    </header>

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
                <td class="px-2 py-4">{{ number_format($item->debet, 0, ',', '.') }}</td>
                <td class="px-2 py-4">{{ number_format($item->kredit, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>