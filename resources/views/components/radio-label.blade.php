@props(['disabled' => false])

<label class="mt-1 flex w-full items-center ps-3 border border-gray-200 rounded-md cursor-pointer">
    <input @disabled($disabled) {{$attributes->merge(['class' => 'w-3 h-3 text-blue-600 bg-gray-100
    border-gray-300 focus:ring-blue-500 focus:ring-2'])}}>
    <span class="py-3 ms-2 text-xs font-medium text-gray-900 uppercase">
        {{$slot}}
    </span>
</label>