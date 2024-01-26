<x-app-layout>
    <div class="flex flex-wrap px-6 sm:px-12 flex-col items-center text-center">
        <x-message :message="session('message')" />
        <x-validation-errors :message="session('message')" />
    </div>
    <div id="heading" class="flex flex-col md:flex-row items-center bg-third text-white">
        <div class="w-full md:w-144 px-4 lg:ml-20 py-8 text-center md:text-start">
            <h1 class="text-4xl md:text-6xl font-light">こころ＋ログ。</h1>
            <div class="relative my-8">
                <p class="text-second mb-12">Let out everything that comes to your mind.
                </p>
                @if(Auth::check())
                    <a href="{{ route('post.create') }}"
                        class="items-center justify-center w-full px-32 lg:px-8 py-2.5 w-full text-sm text-center text-white bg-black hover:drop-shadow-lg duration-200 border-2 border-black rounded-full nline-flex hover:bg-transparent hover:border-black hover:text-black focus:outline-none w-auto focus-visible:outline-black focus-visible:ring-black">
                        Start now
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="items-center justify-center w-full px-32 lg:px-8 py-2.5 w-full text-sm text-center text-white bg-black hover:drop-shadow-lg duration-200 border-2 border-black rounded-full nline-flex hover:bg-transparent hover:border-black hover:text-black focus:outline-none w-auto focus-visible:outline-black focus-visible:ring-black">
                        Start now
                    </a>
                @endif
            </div>
        </div>
        <div class="w-full md:w-3/4 h-96 md:h-screen relative">
            <img src="{{ asset('images/naoshima.jpg') }}" alt=""
                class="absolute inset-0 object-cover object-top h-full w-full">
        </div>
    </div>
    <div class="px-12 py-20 md:py-40 leading-loose md:leading-loose bg-first text-center text-sm md:text-base">
        <p>cocologは日記記録サービスです。<br>日記をつけることでこころのログが算出され、客観的にメンタルヘルスを把握したり、<br>特別な日を記念日に設定することができます。<br><br><br>今日の一日はどんな日でしたか？<br>こころの言葉をアウトプットしてみましょう。
        </p>
    </div>

</x-app-layout>
