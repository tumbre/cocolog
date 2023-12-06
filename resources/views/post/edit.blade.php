@section('title', '「'.$post->title.'」'.'を編集')

<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-2xl text-lg mb-2 text-fourth font-semibold">「{{ $post->title }}」を編集</h2>
    </x-slot>

    @include('components.post-form');
</x-app-layout>
