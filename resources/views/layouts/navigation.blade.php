<nav x-data="{ open: false }" class="mb-12 sm:mb-24 lg:mb-32 text-fourth text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between">
            <!-- ログイン時 -->
            @if(Auth::check())
            <div class="flex items-center">
                <a href="/" class="inline-flex items-center font-semibold text-2xl mb-4">cocolog</a>
                <div class="hidden space-x-8 md:ms-10 md:flex">
                    <a href="{{ route('post.index') }}" class="inline-flex items-center px-1 pt-2 pb-3 border-b border-transparent leading-5 hover:border-seventh transition duration-300 ease-in-out">
                        {{ __('Diary index') }}
                    </a>
                    <a href="{{ route('post.create') }}" class="inline-flex items-center px-1 pt-2 pb-3 border-b border-transparent leading-5 hover:border-seventh transition duration-300 ease-in-out">
                        {{ __('Write a diary') }}
                    </a>
                    <a href="{{ route('chart') }}" class="inline-flex items-center px-1 pt-2 pb-3 border-b border-transparent leading-5 hover:border-seventh transition duration-300 ease-in-out">
                        {{ __('Psycho Log') }}
                    </a>
                    @can('admin')
                    <a href="{{ route('profile.index') }}" class="inline-flex items-center px-1 border-b border-transparent leading-5 hover:border-seventh transition duration-300 ease-in-out">
                        {{ __('User index') }}
                    </a>
                    @endcan
                </div>
            </div>
            <div class="hidden md:flex md:items-center md:ms-6">
                <div class="block ml-auto">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 pt-1 pb-2 font-semibold text-fourth bg-seventh hover:scale-105 focus:outline-none transition ease-in-out duration-200">
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
                </div>
            </div>
            <!-- ハンバーガーアイコン -->
            <div class="-me-2 flex items-center md:hidden">
                @if(Auth::check())
                    <button @click="open = !open" class="fixed z-20 top- right-6 inline-flex items-center justify-center p-2">
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
                <a href="/" class="inline-flex items-center gap-2.5 text-2xl text-seventh font-bold md:text-3xl">cocolog</a>
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
            <a href="/" class="block w-full ps-3 pe-4 py-2 border-r-4 border-b-2 border-transparent text-end text-fourth hover:text-fourth hover:border-seventh focus:outline-none focus:text-fourth transition duration-200 ease-in-out">
                {{ __('HOME') }}
            </a>
            <a href="{{ route('post.index') }}" class="block w-full ps-3 pe-4 py-2 border-r-4 border-b-2 border-transparent text-end text-fourth hover:text-fourth hover:border-seventh focus:outline-none focus:text-fourth transition duration-200 ease-in-out">
                {{ __('Diary index') }}
            </a>
            <a href="{{ route('post.create') }}" class="block w-full ps-3 pe-4 py-2 border-r-4 border-b-2 border-transparent text-end text-fourth hover:text-fourth hover:border-seventh focus:outline-none focus:text-fourth transition duration-200 ease-in-out">
                {{ __('Write a diary') }}
            </a>
            <a href="{{ route('chart') }}" class="block w-full ps-3 pe-4 py-2 border-r-4 border-b-2 border-transparent text-end text-fourth hover:text-fourth hover:border-seventh focus:outline-none focus:text-fourth transition duration-200 ease-in-out">
                {{ __('Psycho Log') }}
            </a>
            @can('admin')
                <a href="{{ route('profile.index') }}" class="block w-full ps-3 pe-4 py-2 border-r-4 border-b-2 border-transparent text-end text-fourth hover:text-fourth hover:border-seventh focus:outline-none focus:text-fourth transition duration-200 ease-in-out">
                    {{ __('User index') }}
                </a>
            @endcan
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
        <a href="{{ route('profile.edit') }}" class="block w-full ps-3 pe-4 py-2 border-r-4 border-b-2 border-transparent text-end text-fourth hover:text-fourth hover:border-seventh focus:outline-none focus:text-fourth transition duration-200 ease-in-out">
            {{ __('Profile') }}
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"  class="block w-full ps-3 pe-4 py-2 border-r-4 border-b-2 border-transparent text-end text-fourth hover:text-fourth hover:border-seventh focus:outline-none focus:text-fourth transition duration-200 ease-in-out">
                {{ __('Log Out') }}
            </a>
        </form>
        @endif
    </div>
</nav>
