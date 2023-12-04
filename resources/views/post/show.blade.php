@section('title', $post->title)

<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-2xl text-lg mb-2 text-fourth font-semibold">{{ $post->title }}</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6 md:p-8 lg:p-12">
        <div class="w-full space-y-5 md:space-y-8">
            <div class="max-w-3xl text-sm sm:text-base mx-auto pb-6 text-end">
                <p>{{ $post->created_at->isoFormat('YYYY/MM/DD(ddd)') }}</p>
            </div>
            <div class="flex items-center">
                @if (isset($previous))
                    <a href="{{ route('post.show', $previous->id) }}" class="inline-flex text-third mb-4 items-center">
                        <i class="fa-solid fa-chevron-left fa-xl py-1 md:py-0 mr-1"></i>
                        {{ $previous->title }}
                    </a>
                @endif
                @if (isset($next))
                    <a href="{{ route('post.show', $next->id) }}" class="inline-flex text-third mb-4 ml-auto items-center">
                        {{ $next->title }}
                        <i class="fa-solid fa-chevron-right fa-xl py-1 md:py-0 ml-1"></i>
                    </a>
                @endif
            </div>
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
                <p class="mt-4 py-4 text-third text-base md:text-lg leading-loose md:leading-loose whitespace-pre-line">{{ $post->body }}</p>
                <div class="mt-20">
                    <div class="text-end text-xs sm:text-sm">
                        <div class="flex justify-end text-third items-center ml-36">
                            <p class="mr-2 sm:mr-4">感情のマグニチュード</p>
                            <a href="{{ route('chart') }}" class="text-end text-base sm:text-lg bg-seventh border border-seventh text-fourth font-bold hover:shadow-lg hover:scale-105 transition ease-in-out duration-300 px-12 sm:px-16 rounded-full">{{ $post->magnitude }}</a>
                        </div>
                        <div class="flex justify-end text-third items-center ml-20 sm:ml-0 mt-1">
                            <i class="fas fa-question-circle  text-xl sm:text-2xl mr-1"></i>
                            <p class="text-xs sm:text-sm">ポジティブ・ネガティブを問わず、数値が大きいほど感情的な表現が多い傾向にあります。</p>
                        </div>
                    </div>
                    <div class="text-end text-xs sm:text-sm mt-12 sm:mt-20">
                        <p class="text-end"></p>
                        <div class="flex justify-end text-third items-center ml-36">
                            <p class="mr-2 sm:mr-4">感情のクオリティ</p>
                            @if($post->score == 5)
                                <a href="/chart#score_chart" class="text-end text-base sm:text-lg bg-second border border-seventh text-white font-bold hover:shadow-lg hover:scale-105 transition ease-in-out duration-300 px-12 sm:px-16 rounded-full">0</a>
                            @elseif($post->score > 0)
                                <a href="/chart#score_chart" class="text-end text-base sm:text-lg bg-fifth border border-seventh text-white font-bold hover:shadow-lg hover:scale-105 transition ease-in-out duration-300 px-12 sm:px-16 rounded-full">{{ $post->score / 10 }}</a>
                            @else
                                <a href="/chart#score_chart" class="text-end text-base sm:text-lg bg-sixth border border-seventh text-white font-bold hover:shadow-lg hover:scale-105 transition ease-in-out duration-300 px-12 sm:px-16 rounded-full">{{ $post->score / 10 }}</a>
                            @endif
                        </div>
                        <div class="flex justify-end text-third items-center ml-20 sm:ml-0 mt-1">
                            <i class="fas fa-question-circle text-xl sm:text-2xl mr-1"></i>
                            <p class="text-xs sm:text-sm">
                                -10~+10の間で、ポジティブ・ネガティブ傾向を示しています。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
