@section('title', $post->title)

<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-2xl text-lg mb-2 text-fourth font-semibold">{{ $post->title }}</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6 md:p-8 lg:p-12">
        <div class="w-full space-y-5 md:space-y-12">
            <div class="text-sm font-semibold flex justify-between items-center">
                @if ($post->anniversary == true)
                    <form method="post" action="{{ route('unlike', ['post' => $post]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="toggle_wish mr-auto text-lg">
                            <i class="fas fa-heart"></i>
                        </button>
                    </form>
                @else
                    <form method="post" action="{{ route('like', ['post' => $post]) }}">
                        @csrf
                        <button type="submit" class="toggle_wish mr-auto text-lg">
                            <i class="far fa-heart"></i>
                        </button>
                    </form>
                @endif
                <p class="text-sm sm:text-base">{{ $post->created_at->isoFormat('YYYY/MM/DD(ddd)') }}</p>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('post.edit', $post) }}"
                    class="inline-flex items-center px-4 py-2 bg-third border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:scale-105 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fa-regular fa-pen-to-square fa-xl md:text-sm md:mr-2 py-1 md:py-0"></i>
                    <div class="hidden md:block">
                        <p>Edit</p>
                    </div>
                </a>
                <form method="post" action="{{ route('post.destroy', $post) }}">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('本当に削除しますか？');"
                        class="inline-flex items-center px-4 py-2 bg-sixth border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:scale-105 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                            class="w-full mx-auto mb-2";>
                    @else
                        <img src="{{ $post->image }}" class="w-full mx-auto mb-2">
                    @endif
                @endif
                <p class="mt-4 py-4 text-third text-base md:text-lg leading-loose md:leading-loose whitespace-pre-line">
                    {{ $post->body }}
                </p>
                <hr class="w-full my-8">
                <div class="flex items-center justify-between space-x-4">
                    @if (isset($previous))
                        <a href="{{ route('post.show', $previous->id) }}" class="inline-flex items-center w-1/2">
                            <i class="fa-solid fa-chevron-left fa-md py-1 md:py-0 mr-4 text-third"></i>
                            <div class="flex flex-col">
                                <p class="text-xs text-gray-500 mb-1">前の日記</p>
                                <p class="text-sm md:text-base font-semibold">{{ $previous->title }}</p>
                            </div>
                        </a>
                    @endif
                    @if (isset($next))
                        <a href="{{ route('post.show', $next->id) }}"
                            class="inline-flex ml-auto items-center w-1/2 text-end justify-end">
                            <div class="flex flex-col">
                                <p class="text-xs text-gray-500 mb-1">次の日記</p>
                                <p class="text-sm md:text-base font-semibold">{{ $next->title }}</p>
                            </div>
                            <i class="fa-solid fa-chevron-right fa-md py-1 md:py-0 ml-4 text-third"></i>
                        </a>
                    @endif
                </div>
                <hr class="w-full my-8">
                <div class="mt-20">
                    <div class="text-end text-xs sm:text-sm">
                        <div class="flex justify-end text-third items-center ml-36">
                            <p class="mr-2 sm:mr-4">感情のマグニチュード</p>
                            <a href="{{ route('chart') }}"
                                class="text-end text-base sm:text-lg bg-seventh border border-seventh text-fourth font-semibold hover:shadow-lg hover:scale-105 transition ease-in-out duration-300 px-12 sm:px-16">{{ $post->magnitude }}</a>
                        </div>
                        <div class="flex justify-end text-third items-center ml-20 sm:ml-0 mt-1">
                            <i class="fas fa-question-circle  text-xl sm:text-2xl mr-1"></i>
                            <p class="text-xs sm:text-sm">ポジティブ・ネガティブを問わず、数値が大きいほど感情的な表現が多い傾向にあります。</p>
                        </div>
                    </div>
                    <div class="text-end text-xs sm:text-sm mt-12 sm:mt-16">
                        <p class="text-end"></p>
                        <div class="flex justify-end text-third items-center ml-36">
                            <p class="mr-2 sm:mr-4">感情のクオリティ</p>
                            @if ($post->score == 5)
                                <a href="/chart#score_chart" class="text-end text-base sm:text-lg bg-second border border-seventh text-white font-semibold hover:shadow-lg hover:scale-105 transition ease-in-out duration-300 px-12 sm:px-16">0</a>
                            @elseif($post->score > 0)
                                <a href="/chart#score_chart" class="text-end text-base sm:text-lg bg-fifth border border-seventh text-white font-semibold hover:shadow-lg hover:scale-105 transition ease-in-out duration-300 px-12 sm:px-16">{{ $post->score / 10 }}</a>
                            @else
                                <a href="/chart#score_chart" class="text-end text-base sm:text-lg bg-sixth border border-seventh text-white font-semibold hover:shadow-lg hover:scale-105 transition ease-in-out duration-300 px-12 sm:px-16">{{ $post->score / 10 }}</a>
                            @endif
                        </div>
                        <div class="flex justify-end text-third items-center ml-20 sm:ml-0 mt-1">
                            <i class="fas fa-question-circle text-xl sm:text-2xl mr-1"></i>
                            <p class="text-xs sm:text-sm">-10~+10の間で、ポジティブ・ネガティブ傾向を示しています。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
