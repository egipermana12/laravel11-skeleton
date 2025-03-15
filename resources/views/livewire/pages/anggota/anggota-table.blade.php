<div class="mt-6">
    <div class="text-gray-900 dark:text-gray-100">
        <div class="my-2 flex items-center justify-between">
            <x-text-input type="text" id="cariUser"
                class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                placeholder="cari nama atau email" autocomplete="off" />
            <div class="flex items-center justify-between gap-x-2">
                <select class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        {{-- table --}}
        <table class="table-auto w-full text-left text-sm rtl:text-right text-gray-500">
            <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-2 py-4 text-center" width="4%">No</th>
                    <th class="px-2 py-4 text-center" width="4%">
                        <input type="checkbox"
                            class="w-4 h-4 text-center text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                    </th>
                    <th class="px-2 py-4 cursor-pointer" width="25%">
                        NIK
                    </th>
                    <th class="px-2 py-4 cursor-pointer" width="25%">
                        Nama
                    </th>
                    <th class="px-2 py-4 cursor-pointer" width="15%">
                        Jenis Kelamin
                    </th>
                    <th class="px-2 py-4 cursor-pointer" width="15%">
                        Status
                    </th>
                    <th class="px-2 py-4 text-center" width="8%">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>