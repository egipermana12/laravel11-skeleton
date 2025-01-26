@props(['show' => true])

<aside id="drawer-navigation" @class(['fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform bg-white'
    ,
    '-translate-x-full' => !$show
    ]) tabindex="-1" aria-labelledy="drawer-navigation-labe">
    <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase">
        Menu
    </h5>
</aside>
