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
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="my-2 flex items-center justify-between">
                    <x-text-input wire:model.live="cariUser" type="text" id="cariUser"
                        class="w-1/4 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                        placeholder="cari nama atau email" autocomplete="off" />
                    <div class="flex items-center justify-between gap-x-2">
                        <select wire:model.live="pageStart"
                            class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <div>
                            <select wire:model.live="cariRole"
                                class="bg-gray-100 border border-gray-200 text-gray-900 text-sm rounded-lg">
                                <option value="">Semua Role</option>
                                @foreach($roles as $index => $role)
                                <option value={{$role->id}}>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button wire:click="$dispatch('openUserForm')"
                            class="bg-gray-900 text-white font-semibold text-sm px-3 py-2 rounded-md hover:bg-gray-700">
                            <i class="fa-solid fa-circle-plus"></i>&nbsp;&nbsp;Add User
                        </button>
                        <button
                            class="bg-red-700 text-white font-semibold text-sm px-3 py-2 rounded-md hover:bg-red-900"
                            :class="{{count($checked) > 0 ? "'block'" : "'hidden'" }}">
                            Delete User
                        </button>
                    </div>
                </div>

                <table class="table-auto w-full text-left text-sm rtl:text-right text-gray-500">
                    <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-2 py-4 text-center" width="4%">No</th>
                            <th class="px-2 py-4 text-center" width="4%">
                                <input wire:model.live="selectAll" type="checkbox"
                                    class="w-4 h-4 text-center text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                            </th>
                            <th wire:click="sortField('name')" class="px-2 py-4 cursor-pointer">
                                <x-sort sortDirection="{{$sortDirection}}" /> Nama
                            </th>
                            <th wire:click="sortField('email')" class="px-2 py-4 cursor-pointer">
                                <x-sort sortDirection="{{$sortDirection}}" /> Email
                            </th>
                            <th class="px-2 py-4">Role</th>
                            <th class="px-2 py-4 text-center" width="8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-b border-gray-100 text-sm" wire.loading.class="opacity-50">
                        @foreach($users as $index => $user)
                        <tr class="border-b border-gray-100 " wire:key="{{$user->id}}">
                            <td class="px-2 py-4 text-center">{{ $users->firstItem() + $index }}</td>
                            <td class="px-2 py-4 text-center">
                                <input wire:model.live="checked" wire:key="checkbox-{{ $user->id }}" type="checkbox"
                                    value="{{$user->id}}"
                                    class="w-4 h-4 text-center text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                            </td>
                            <td class="px-2 py-4">{{$user->id}} . {{ $user->name }}</td>
                            <td class="px-2 py-4">{{ $user->email }}</td>
                            <td class="px-2 py-4">
                                @if($user->getRoleNames()->isNotEmpty())
                                <x-badge :role="$user->getRoleNames()[0]" />
                                @else
                                <x-badge role="No Roe" />
                                @endif
                            </td>
                            <td class="px-2 py-4">
                                <div class="flex items-center justify-center gap-x-3">
                                    <button wire:click="$dispatch('openUserEdit', {id: {{$user->id}} })"
                                        class="cursor-pointer text-center"><i
                                            class="fa-solid fa-pen-to-square text-slate-400 hover:text-blue-600 text-xs"></i></button>
                                    <button
                                        wire:click="$dispatch('openUserDelete', {id: {{$user->id}}, name: '{{$user->name}}' })"
                                        class="cursor-pointer text-center">
                                        <i class="fa-solid fa-trash text-slate-400 hover:text-red-600 text-xs"></i></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $users->onEachSide(3)->links() }}
                </div>
            </div>
        </div>
    </div>
    <livewire:pages.users.user-form />
    <livewire:pages.users.user-edit />
    <livewire:pages.users.user-delete />
</div>