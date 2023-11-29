@section('title', $post->title)

<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-2xl text-lg mb-2 text-fourth">{{ $post->title }}</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6 md:p-8 lg:p-12">
        <div class="w-full space-y-5 md:space-y-8">
            <div class="flex justify-end mt-4 space-x-4">
                <a href="{{ route('post.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-third border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:scale-105 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fa-regular fa-pen-to-square fa-xl md:text-sm md:mr-2 py-1 md:py-0"></i>
                    <div class="hidden md:block">
                        <p>Edit</p>
                    </div>
                </a>
                <form method="post" action="{{ route('post.destroy', $post) }}">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('本当に削除しますか？');" class="inline-flex items-center px-4 py-2 bg-sixth border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:scale-105 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fa-regular fa-trash-can fa-xl md:text-sm md:mr-2 py-1 md:py-0"></i>
                        <a class="hidden md:block">
                            <p>Delete</p>
                        </a>
                    </button>
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
