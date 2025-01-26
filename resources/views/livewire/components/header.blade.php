<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<header class="bg-white border-b border-l-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center cursor-pointer" @click="show = !show">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
    </div>
</header>
