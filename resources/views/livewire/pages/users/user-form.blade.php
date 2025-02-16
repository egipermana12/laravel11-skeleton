<div>
    @if($isOpen)
    <div class="fixed z-50 inset-0 flex items-start justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white rounded-md shadow-md w-2/3 max-h-full mt-10">
            <div class="p-4 flex items-center justify-between border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Form</h2>
                <button
                    wire:click="closeModal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray=900 rounded-md text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                >
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="py-24"></div>
        </div>
    </div>
    @endif
</div>
