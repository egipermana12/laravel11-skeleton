<x-modalcustom name="user-create" wire:model.live="isOpen">
    <form wire:submit.prevent="store">
        <div class="p-4 flex items-center justify-between border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form User</h2>
            <button type="button" wire:click="closeModal"
                class="text-gray-400 bg-gray-100 hover:bg-gray-200 hover:text-gray=900 rounded-md text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div class="px-4 py-6 space-y-4">
            <div>
                <x-input-label class="text-xs" for="form.name" :value="__('Name')" />
                <x-text-input wire:model="form.name" id="form.name" type="text" class="mt-1 block w-full text-sm"
                    autofocus autocomplete="form.form.name" />
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.name')" />
            </div>
            <div>
                <x-input-label class="text-xs" for="form.email" :value="__('Email')" />
                <x-text-input wire:model="form.email" id="form.email" type="email" class="mt-1 block w-full text-sm"
                    autofocus autocomplete="new-email" autocomplete="off" />
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.email')" />
            </div>
            <div>
                <x-input-label class="text-xs" for="form.password" :value="__('Password')" />
                <x-text-input wire:model="form.password" id="password" type="password" class="mt-1 block w-full text-sm"
                    autofocus autocomplete="new-password" autocomplete="off" />
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.password')" />
            </div>
            <div>
                <x-input-label class="text-xs" for="form.roles" :value="__('Role')" />
                <div class="flex items-start gap-2 w-full mt-1">
                    @foreach($roles as $role)
                    <x-radio-label name="radio-role" type="radio" id="{{$role->id}}" wire:model="form.roles"
                        value="{{$role->id}}">
                        {{$role->name}}
                    </x-radio-label>
                    @endforeach
                </div>
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.roles')" />
            </div>
            <div>
                <x-input-label class="text-xs" for="form.status" :value="__('Permissions')" />
                <x-input-error class="mt-2 text-xs" :messages="$errors->get('form.permissions')" />
                <div class="grid grid-cols-3 gap-2">
                    @foreach ($permissions as $modul => $perms)
                    <div class="w-full p-2 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <p class="font-medium text-sm">{{ ucfirst($modul) }}</p>
                        @foreach ($perms as $perm)
                        <label class="block">
                            <input class="text-xs text-blue-600" type="radio" wire:model="form.permissions.{{$modul}}"
                                value="{{ $perm->name }}">
                            <span class="text-sm text-gray-500">{{ ucfirst(str_replace("$modul.", '', $perm->name))
                                }}</span>
                        </label>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end mt-4 p-4">
            <x-primary-button type="button" wire:click="closeModal" class="ms-4 bg-red-500 text-white hover:bg-red-700">
                {{ __('Batal') }}
            </x-primary-button>
            <x-primary-button wire:loading.attr="disable" class="ms-4">
                {{ __('Simpan') }}
            </x-primary-button>
        </div>
    </form>
</x-modalcustom>