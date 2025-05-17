<div class="py-2">
    <div class="max-w-7xl mx-auto px-2">
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
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm relative">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex items-center justify-between">
                    <h5 class="font-semibold text-gray-800">Jurnal Umum</h5>
                    <div class="relative" x-data="{openExport: false}">
                        <button @click="openExport =!openExport"
                            class="bg-gray-900 text-white font-semibold text-sm px-3 py-2 rounded-md hover:bg-gray-700">
                            <i class="fa-solid fa-download"></i>&nbsp;&nbsp;Export Data
                        </button>
                        <div x-show="openExport" @click.outside="openExport = false"
                            class="absolute top-10 right-0 bg-white rounded-md z-50 w-48 border border-gray-200 p-2 text-sm shadow-md">
                            <a target="_blank" class="w-full block text-gray-800 hover:bg-gray-100 py-3 px-2 rounded-md"
                                href="{{route('jurnalumumPDF', ['startOfMonth' => $startOfMonth, 'endOfMonth' => $endOfMonth]) }}">
                                <i class="fa-solid fa-file-pdf"></i>&nbsp;&nbsp;Export PDF
                            </a>
                            <a target="_blank" class="w-full block text-gray-800 hover:bg-gray-100 py-3 px-2 rounded-md"
                                href="{{route('jurnalumumEXCEL', ['startOfMonth' => $startOfMonth, 'endOfMonth' => $endOfMonth]) }}">
                                <i class="fa-solid fa-file-excel"></i>&nbsp;&nbsp;Export EXCEL
                            </a>
                        </div>
                    </div>
                </div>

                <livewire:pages.jurnalumum.jurnal-umum-table />
            </div>
        </div>
    </div>
</div>