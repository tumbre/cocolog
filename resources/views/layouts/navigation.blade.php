<nav x-data="{ open: false }" class="mb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- ログイン時 -->
            @if(Auth::check())
            <div class="flex items-center">
                <a href="/" class="inline-flex items-center gap-2.5 text-2xl text-fourth md:text-3xl">cocolog</a>
                <div class="hidden space-x-8 md:ms-10 md:flex">
                    <x-nav-link :href="url('/')" :active="request()->is('/')">
                        ホーム
                    </x-nav-link>
                    <x-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
                        日記を読む
                    </x-nav-link>
                    <x-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
                        日記を書く
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        {{ __('Profile') }}
                    </x-nav-link>
                </div>
            </div>
            <div class="hidden md:flex md:items-center md:ms-6">
                <div class="block ml-auto">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-nav-link>
                    </form>
                </div>
            </div>
            <!-- ハンバーガーアイコン -->
            <div class="-me-2 flex items-center md:hidden">
                @if(Auth::check())
                    <button @click="open = !open" class="fixed z-20 top- right-6 inline-flex items-center justify-center p-2 text-fourth">
                        <i id="bars" class="fa-solid fa-bars text-2xl" :class="{ 'hidden': open }"></i>
                        <i id="xmark" class="fa-solid fa-x text-2xl" :class="{ 'hidden': !open }"></i>
                    </button>  
                @else
                    <a href="{{ route('login') }}"
                        class="px-3 py-2 text-fourth border-b border-transparent hover:border-fourth transition ease-in-out duration-300">
                        {{ __('Login') }}
                    </a>
                @endif
            </div>

            <!-- ログアウト時 -->
            @else
            <div class="flex items-center">
                <a href="/" class="inline-flex items-center gap-2.5 text-2xl md:text-3xl">cocolog</a>
            </div>
            <div class="flex items-center ms-6">
                <div class="block ml-auto">
                    <a href="{{ route('login') }}"
                        class="px-3 py-2 border-b border-transparent hover:border-seventh transition ease-in-out duration-300">
                        {{ __('Login') }}
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- ハンバーガーメニュー -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden fixed w-full top-0 right-0 pt-12 z-10 bg-first">
        @if(Auth::check())
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                ホーム
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
                日記を読む
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
                日記を書く
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>        
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-end text-gray-800">
                    {{ Auth::user()->name }}
                </div>
                <div class="font-medium text-sm text-end text-gray-500">
                    {{ Auth::user()->email }}
                </div>
            </div>
        </div>
        @endif
    </div>
</nav>
