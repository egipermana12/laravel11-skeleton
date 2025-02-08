<?php

use Livewire\Volt\Component;
use App\Livewire\Actions\Logout;

new class () extends Component {
    //
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<header class="bg-white border-b border-l-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center cursor-pointer" @click="show = !show">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
            <div class="relative" x-data="{openProfile : false}">
                <div class="flex">
                    <div
                        @click="openProfile = !openProfile"
                        class="relative w-8 h-8 flex items-center justify-center cursor-pointer bg-slate-100 border border-slate-300 rounded-md">
                        <i class="fa-regular fa-user"></i>
                    </div>
                </div>
                <div
                    x-show="openProfile"
                    @click.outside = "openProfile = false"
                    class="absolute top-8 right-0 bg-white
                    rounded-md z-50 w-48 border border-gray-200
                    p-2 text-sm shadow-md
                    ">
                    <div>
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
