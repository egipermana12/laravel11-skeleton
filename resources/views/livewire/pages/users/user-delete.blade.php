<x-modalcustom name="user-delete" wire:model.live="openModalDelete">
    <div class="px-4 py-6 space-y-4">
        <p>Apakah Anda yakin ingin menghapus user <strong>{{ $name }}</strong>?</p>
    </div>
    <div class="flex items-center justify-end mt-4 p-4">
        <x-primary-button type="button" wire:click="$set('openModalDelete', false)" wire:loading.attr="disable"
            class="ms-4 bg-red-500 text-white hover:bg-red-700">
            {{ __('Batal') }}
        </x-primary-button>
        <x-primary-button wire:click="delete" wire:loading.attr="disable" class="ms-4">
            {{ __('Yakin') }}
        </x-primary-button>
    </div>
</x-modalcustom>