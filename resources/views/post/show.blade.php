@section('title', $post->title)

<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-2xl text-lg mb-2 text-fourth">{{ $post->title }}</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6 md:p-8 lg:p-12">
        <div class="w-full space-y-5 md:space-y-8">
            <div class="flex justify-end mt-4">
                <a href="{{ route('post.edit', $post) }}"><x-primary-button
                        class="bg-fifth float-right">編集</x-primary-button></a>
                <form method="post" action="{{ route('post.destroy', $post) }}">
                    @csrf
                    @method('delete')
                    <x-primary-button class="bg-sixth float-right ml-4"
                        onclick="return confirm('本当に削除しますか？');">削除</x-primary-button>
                </form>
            </div>
            <div>
                @if ($post->image)
                    @if (app()->isLocal())
                        <img src="{{ asset('storage/images/' . $post->image) }}"
                            class="w-full mx-auto rounded-lg mb-2";>
                    @else
                        <img src="{{ $post->image }}" class="w-full mx-auto rounded-lg mb-2">
                    @endif
                @endif
                <p class="mt-4 text-gray-600 py-4 whitespace-pre-line">{{ $post->body }}</p>
                <div class="text-sm font-semibold flex flex-row-reverse">
                    <p>{{ $post->user->name }}・{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
