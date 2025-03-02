@props(['sortDirection' => null, 'sortBy' => null, 'field' => null])

@if($sortBy === $field)
@if($sortDirection === 'asc')
<i class="fa-solid fa-arrow-up-a-z text-blue-500"></i>
@else
<i class="fa-solid fa-arrow-up-z-a text-red-500"></i>
@endif
@endif