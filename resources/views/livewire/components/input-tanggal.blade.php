<div class="flex">
    <span
        class="mt-1 inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md">
        <i class="fa-regular fa-calendar"></i>
    </span>
    <input type="text" value="{{$tanggal}}" x-data x-ref="tglInput" x-init="
        new pikaday({
                            field: $refs.tglInput,
                            format: 'YYYY-MM-DD',
                            toString(date, format) {
                                const day = String(date.getDate()).padStart(2, 0);
                                const month = String(date.getMonth() + 1).padStart(2, 0);
                                const year = date.getFullYear();
                                return `${year}-${month}-${day}`;
                            },
                            onSelect: function() {
                                $wire.set('tanggal', moment(this.getDate()).format('YYYY-MM-DD'));
                            }
                        })
    " class="block rounded-none rounded-e-lg border-gray-300
 focus:border-indigo-500  focus:ring-indigo-500 dark:focus:ring-indigo-600
 shadow-sm {{$class}}">

</div>