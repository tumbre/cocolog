@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full py-2 sm:py-4 border-second focus:border-seventh focus:ring-seventh rounded-full shadow-sm']) !!}>
