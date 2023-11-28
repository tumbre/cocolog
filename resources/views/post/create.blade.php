@section('title', '日記を書く')

<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-2xl text-lg mb-2 text-fourth">日記を書く</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                        <label for="title" class="font-semibold leading-none mt-6 mb-2">タイトル</label>
                        <input type="text" name="title"
                            class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md border-second focus:border-seventh focus:ring-seventh"
                            id="title" value="{{ old('title') }}" placeholder="Enter Title">
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    <label for="body" class="font-semibold leading-none mt-6 mb-2">本文</label>
                    <textarea name="body"
                        class="w-auto py-2 border border-gray-300 rounded-md h-96 border-second focus:border-seventh focus:ring-seventh"
                        id="body">{{ old('body') }}</textarea>
                </div>

                <div class="mt-8 mb-20">
                    @include('components.preview')
                </div>

                <button type="submit"
                    class="my-12 w-full bg-fifth text-white rounded-full border border-seventh cursor-pointer hover:shadow-lg transition duration-300 ease-in-out">
                    <div class="flex items-center justify-center">
                        <i class="fa-solid fa-pen-fancy"></i>
                        <p class="ml-2">記録する</p>
                    </div>
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
