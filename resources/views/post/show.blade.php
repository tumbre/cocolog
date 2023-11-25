<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-3xl text-2xl mb-2 text-fourth">{{ $post->title }}</h2>
        <x-message :message="session('message')" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Blog Article -->
        <div class="max-w-3xl px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
            <div class="max-w-2xl">
                <!-- Content -->
                <div class="max-w-2xl space-y-5 md:space-y-8">
                    <div class="space-y-3">
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
                            <p class="mt-4 text-gray-600 py-4 whitespace-pre-line">{{ $post->body }}</p>
                            @if ($post->image)
                                <img src="{{ asset('storage/images/' . $post->image) }}" class="w-full mx-auto mb-2";">
                            @endif
                            <div class="text-sm font-semibold flex flex-row-reverse">
                                <p>{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Content -->
            </div>
        </div>
        <!-- End Blog Article -->
    </div>
</x-app-layout>
