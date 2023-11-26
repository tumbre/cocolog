<x-app-layout>
    <section class="text-third body-font">
        <div class="container px-5 py-24 mx-auto">
            <x-slot name="header">
                <h2 class="sm:text-3xl text-2xl mb-2 text-fourth">日記を読む</h2>
                <x-message :message="session('message')" />
            </x-slot>

            @if (count($posts) == 0)
                <section class="max-w-5xl text-center">
                    <p class="mt-4">まだ日記がありません📖<br>初めての日記を書いてみましょう。<br>
                        <button type="submit"
                            class="py-3 text-center text-sm md:text-base hover:scale-110 transition duration-300">
                            <i class="fa-solid fa-pen-fancy"></i>
                            <a href="{{ route('post.create') }}" class="ml-2">Start now</a>
                        </button>
                    </p>
                </section>
            @else
                <div class="flex flex-wrap -m-4">
                    @foreach ($posts as $post)
                        <section class="xl:w-1/3 md:w-1/2 p-4">
                            <a href="{{ route('post.show', $post) }}" class="w-full">
                                <div class="bg-white w-full rounded-lg p-6 flex flex-col h-full hover:scale-105 hover:shadow-lg transition duration-200">
                                    <div class="mb-4"></div>
                                    <h2 class="text-lg text-gray-900 font-bold title-font mb-1">{{ $post->title }}</h2>
                                    <hr class="w-full mb-8">
                                    <div class="mb-4">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/images/' . $post->image) }}" class="h-52 rounded w-full object-cover object-center mb-6";>
                                        @endif
                                    </div>
                                    <p class="flex-grow leading-relaxed text-base mb-8">
                                        {{ Str::limit($post->body, 100, '...') }}</p>
                                    <div class="text-sm font-semibold flex flex-row-reverse">
                                        <p>{{ $post->user->name }}・{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </a>
                        </section>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
