@props(['role' => 'No Role'])

@php
    $colors = [
        'admin' => 'bg-red-100 text-red-600',
        'operator' => 'bg-blue-100 text-blue-600'
    ];
    $colorClass = $colors[$role] ?? 'bg-gray-100 text-gray-800';
@endphp

<span {{ $attributes->merge(['class' => "p-1 rounded-sm text-xs $colorClass" ]) }} >
    {{ ucfirst($role) }}
</span>
