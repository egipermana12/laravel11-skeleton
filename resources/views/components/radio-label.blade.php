@props(['disabled' => false])

<label class="flex items-center ps-4 border border-gray-200 rounded-sm w-full cursor-pointer">
    <input @disabled($disabled) {{$attributes->merge(['class' => 'w-4 h-4 text-blue-600 bg-gray-100
    border-gray-300 focus:ring-blue-500 focus:ring-2'])}}>
    <span class="w-full py-4 ms-2 text-sm font-medium text-gray-900 capitalize">
        {{$slot}}
    </span>
</label>