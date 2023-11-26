<x-app-layout>
    <div class="pb-6 sm:pb-8 lg:pb-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <section class="flex flex-col justify-center items-center gap-6 sm:gap-10 md:gap-16 lg:flex-row lg:items-end">
                <div class="flex flex-col justify-center sm:text-center lg:py-12 lg:text-left xl:w-5/12 xl:py-24">
                    <p class="mb-4 font-semibold text-third md:mb-6 md:text-lg xl:text-xl">Let out everything that comes to your mind.</p>
                    <h1 class="mb-8 text-5xl sm:text-7xl md:mb-12 md:text-7xl">こころ＋ログ。</h1>
                    <p class="mb-8 leading-relaxed text-third md:mb-12 lg:w-4/5 xl:text-lg">cocologはこころのログを取るサービスです。<br>私たちは自分が思っているよりも自分のことを知りません。<br>気が付いたら同じところをぐるぐる回っていた、！なんてこともあるかもしれません。<br><br>cocologは、そんな状況を客観視する機会を提供します。<br>客観視することで、思考のループから抜け出すことができます。<br>ループから抜け出せれば、軽やかに行動できます。<br><br>今日の一日はどんな日でしたか？<br>まずは一行だけ、こころの言葉をアウトプットしてみましょう。</p>
                    @if(Auth::check())
                        <a href="{{ route('post.create') }}" class="flex flex-col gap-2.5 sm:flex-row sm:justify-center lg:justify-start">
                    @else
                    <a href="{{ route('login') }}" class="flex flex-col gap-2.5 sm:flex-row sm:justify-center lg:justify-start">
                    @endif
                        <button type="submit" class="rounded-full bg-fifth px-8 py-3 text-center text-sm md:text-base text-white hover:scale-110 shadow-lg transition duration-300">
                            <div class="flex items-center justify-center">
                                <i class="fa-solid fa-pen-fancy"></i>
                                <p class="ml-2">Start now</p>
                            </div>
                        </button>
                    </a>
                </div>
                <div>
                    <img src="{{ asset('logo/thinking.png') }}" loading="lazy" alt="Thinking man" class="mix-blend-multiply h-96 object-cover object-center lg:mb-24">
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
