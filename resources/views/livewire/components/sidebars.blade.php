<aside id="drawwer-nav" class="fixed top-0 lef-0 px-2 py-4 z-40 h-screen overflow-y-auto bg-gray-800"
        :class="show ? 'w-64' : 'w-16'"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform -translate-x-full"
        tabindex="-1" aria-labbeledby="drawwer-nav"
    >
    <span id="drawwer-nav-label" class="">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-200 dark:text-gray-200" />
    </span>
    <nav class="h-full overflow-y-auto overflow-x-hidden my-2">
        <ul class="">
            @foreach ($menus as $value)
                @if (count($value->children) > 0)
                <div
                    class="hover:bg-gray-600 hover:text-gray-100 rounded"
                    x-data="{openSideChild : false}"
                    wire:key="{{ $value->id }}"
                >
                    <button
                        class="sidebar-button-dropdown"
                        @click="openSideChild = !openSideChild"
                    >
                        <i class="{{$value->class}}"></i>
                        <span class="ms-3">{{$value->menu_title}}</span>
                        <i class="fa-solid fa-chevron-down justify-self-end"
                            :class = "[openSideChild ? 'transform rotate-180' : 'transform rotate-0']"></i>
                    </button>
                    <ul id="dropdown-sidebar"
                        class="px-14"
                        x-show="openSideChild"
                        @click.outside="openSideChild = false"
                    >
                        @foreach($value->children as $sub)
                        <li>
                            <a href={{$sub->slug}} class="sidebar-button-dropdown-href">{{$sub->menu_title}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @else
                    <li wire:key="{{ $value->id }}">
                        <a href={{ $value->slug }} class="sidebar-href">
                            <i class="{{ $value->class }}"></i>
                            <span class="ms-3">{{ $value->menu_title }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
</aside>
