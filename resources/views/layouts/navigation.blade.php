<nav x-data="{ open: false }" class="mb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- メニュー -->
            <div class="flex">
                <a href="/" class="inline-flex items-center gap-2.5 text-2xl text-fourth md:text-3xl">cocolog</a>
                @if(Auth::check())
                    <div class="hidden space-x-8 md:ms-10 md:flex">
                        <x-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
                            日記を読む
                        </x-nav-link>
                        <x-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
                            日記を書く
                        </x-nav-link>
                    </div>
                @endif
            </div>

            <!-- アカウント情報バッジ -->
            <div class="hidden md:flex md:items-center md:ms-6">
                @if(Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 text-sm leading-4 rounded-md border border-seventh hover:scale-105 focus:outline-none transition ease-in-out duration-200">
                                <div>
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="ms-1">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="px-3 py-2 text-fourth border-b border-transparent hover:border-fourth transition ease-in-out duration-300">
                        {{ __('Login') }}
                    </a>
                @endif
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
        </div>
    </div>

    <!-- ハンバーガークリック時のメニュー -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden fixed w-full top-12 right-0 z-10 bg-white">
        @if(Auth::check())
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
                    HOME
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
                    新規作成
                </x-responsive-nav-link>
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

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="block w-full ps-3 pe-4 py-2 border-r-4 border-transparent text-end text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                {{ __('Login') }}
            </a>
        @endif
    </div>
</nav>
