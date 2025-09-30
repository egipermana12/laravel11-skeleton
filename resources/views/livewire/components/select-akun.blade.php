<div class="w-full">
    <select wire:model="selectedValue" class="{{$class}}">
        <option value="">Pilih Akun</option>
        @foreach($options as $id => $nama)
        <option value="{{  $nama['akun_id'] . '.' . $nama['kd_akun1']  }}" @selected($selectedValue==$nama['kd_akun1'])>
            {{ $nama['kd_akun1'] . '.
            '.$nama['nama_akun'] }}</option>
        @endforeach
    </select>
</div>