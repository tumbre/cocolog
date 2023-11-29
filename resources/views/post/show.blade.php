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
                    <p>{{ $post->created_at->isoFormat('YYYY/MM/DD(ddd)') }}・{{ $post->created_at->diffForHumans() }}</p>
                </div>
                <div class="mt-20">
                    <div class="text-end text-xs sm:text-sm">
                        <div class="flex justify-end text-third items-center ml-36">
                            <p class="mr-2 sm:mr-4">感情のマグニチュード</p>
                            <p class="text-end text-base sm:text-lg bg-seventh border border-seventh text-fourth font-bold shadow-lg px-12 sm:px-16 rounded-full">{{ $post->magnitude }}</p>
                        </div>
                        <p class="text-end mt-2">ポジティブ・ネガティブを問わず、数値が大きいほど感情的な表現が多い傾向にあります。</p>
                    </div>
                    <div class="text-end text-xs sm:text-sm mt-12 sm:mt-20">
                        <p class="text-end"></p>
                        <div class="flex justify-end text-third items-center ml-36">
                            <p class="mr-2 sm:mr-4">感情のクオリティ</p>
                            @if($post->score > 0)
                                <p class="text-end text-base sm:text-lg bg-fifth border border-seventh text-white font-bold shadow-lg px-12 sm:px-16 rounded-full">{{ $post->score }}</p>
                            @else
                                <p class="text-end text-base sm:text-lg bg-sixth border border-seventh text-white font-bold shadow-lg px-12 sm:px-16 rounded-full">{{ $post->score }}</p>
                            @endif
                        </div>
                        <p class="text-end mt-2">-10~+10の間で、数値が大きいほどポジティブな表現が多い傾向にあります。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
