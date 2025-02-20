@props(['disabled' => false])

<div class="flex items-center ps-4 border border-gray-200 rounded-sm w-full">
    <input @disabled($disabled) {{$attributes->merge(['class' => 'w-4 h-4 text-blue-600 bg-gray-100
    border-gray-300 focus:ring-blue-500 focus:ring-2'])}}>
    {{$slot}}
</div>