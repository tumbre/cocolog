<x-app-layout>
    <section class="text-third body-font">
        <div class="container px-5 py-24 mx-auto">
            <x-slot name="header">
                <h2 class="sm:text-3xl text-2xl mb-2 text-fourth">日記を読む</h2>
                <p class="w-full leading-relaxed text-gray-500">Let out everything that comes to your mind.
                    Don't deny it, just overlook the feelings that are there.
                    When you let it all out, your heart will feel lighter and lighter.
                </p>
                <x-message :message="session('message')" />
            </x-slot>

            <div class="flex flex-wrap -m-4">
                @foreach ($posts as $post)
                    <section class="xl:w-1/3 md:w-1/2 p-4">
                        <a href="{{ route('post.show', $post) }}" class="w-full">
                            <div class="bg-white w-full rounded-lg p-6 flex flex-col h-full">
                                <div class="mb-4"></div>
                                <h2 class="text-lg text-gray-900 font-bold title-font mb-1">{{ $post->title }}</h2>
                                <hr class="w-full mb-8">
                                <p class="flex-grow leading-relaxed text-base mb-8">{{ Str::limit($post->body, 100, '...') }}</p>
                                <div class="text-sm font-semibold flex flex-row-reverse">
                                    <p>{{ $post->user->name }}・{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </a>
                    </section>
                @endforeach
            </div>            
        </div>
    </section>
</x-app-layout>
