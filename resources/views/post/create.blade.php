@section('title', __('Write a diary'))

<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-2xl text-lg mb-2 text-fourth font-semibold">{{ __('Write a diary') }}</h2>
    </x-slot>

    @include('components.post-form')
</x-app-layout>
