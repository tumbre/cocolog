@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 pb-2 border-b border-seventh leading-5 text-fourth font-bold transition duration-300 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 pb-2 border-b border-transparent leading-5 text-third hover:text-fourth hover:border-seventh transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
