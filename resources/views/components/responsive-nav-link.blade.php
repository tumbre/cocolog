@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-r-4 border-b-2 border-seventh text-end text-fourth transition duration-300 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-r-4 border-b-2 border-transparent text-end text-second hover:text-fourth hover:border-seventh focus:outline-none focus:text-fourth transition duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
