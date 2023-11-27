<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-3xl text-2xl mb-2 text-fourth">日記を書く</h2>
        <x-message :message="session('message')" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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

                <div class="w-full flex flex-col">
                    <label for="image" class="font-semibold leading-none mt-6 mb-2">画像（1MBまで） </label>
                    <div>
                        <input id="image" type="file" name="image">
                    </div>
                </div>

                <x-primary-button class="mt-12 bg-sixth">記録する✍️</x-primary-button>

            </form>
        </div>
    </div>
</x-app-layout>
