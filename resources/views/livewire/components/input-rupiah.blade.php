<div class="flex">
    <span
        class="mt-1 inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md">
        Rp
    </span>
    <input type="text" value="{{$harga}}" x-data x-ref="hargaInput" x-init="
            $watch('$wire.harga', value => $refs.hargaInput.value = formatRupiah(value.toString()))
        " x-on:input.debounce.300ms="
            let raw = $event.target.value.replace(/\D/g, '');
            $wire.harga = parseInt(raw || 0);
            $event.target.value = formatRupiah(raw);
        " class="block rounded-none rounded-e-lg border-gray-300
 focus:border-indigo-500  focus:ring-indigo-500 dark:focus:ring-indigo-600
 shadow-sm {{$class}}">
    <script>
        function formatRupiah(angka) {
                return angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
    </script>
</div>