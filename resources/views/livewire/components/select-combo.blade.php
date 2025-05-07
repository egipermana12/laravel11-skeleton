<div>
    <select wire:model="selectedValue"
        class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg {{$class}}" @disabled($disable)>
        @unless($disable)
        <option value="">{{ $textAtas }}</option>
        @endunless

        @foreach ($selectOpsi as $id => $nama)
        <option value="{{ $id }}" @selected($selectedValue==$id)>{{ $nama }}</option>
        @endforeach
    </select>
</div>