<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto px-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in ges!") }}

                </div>
                <h3 class="font-bold mt-4">User Permissions</h3>
                <ul>
                    @foreach (Auth::user()->getPermissionNames() as $permission)
                    <li>{{ $permission }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>