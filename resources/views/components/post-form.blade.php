<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-40">
    <div class="mx-4 sm:p-8">
        @if (isset($post))
            <form method="post" action="{{ route('post.update', $post) }}" enctype="multipart/form-data">
                @method('patch')
            @else
                <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="md:flex items-center my-8">
            <div class="w-full flex flex-col">
                <label for="created_at" class="font-semibold leading-none mt-6 mb-2">日付</label>
                <input type="date" name="created_at"
                    class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md border-second focus:border-seventh focus:ring-seventh"
                    @if (isset($post))
                        value="{{ old('created_at', $post->created_at->format('Y-m-d')) }}"
                    @else
                        value="{{ old('created_at') }}"
                        id="today"
                    @endif>
            </div>
        </div>

        <div class="md:flex items-center my-8">
            <div class="w-full flex flex-col">
                <label for="title" class="font-semibold leading-none mt-6 mb-2">タイトル</label>
                <input type="text" name="title"
                    class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md border-second focus:border-seventh focus:ring-seventh"
                    id="title"
                    placeholder="Enter Title"
                    @if (isset($post))
                        value="{{ old('title', $post->title) }}"
                    @else
                        value="{{ old('title') }}"
                    @endif>
            </div>
        </div>

        <div class="w-full flex flex-col">
            <label for="body" class="font-semibold leading-none mt-6 mb-2">本文</label>
            <textarea name="body"
                class="w-auto py-2 border border-gray-300 rounded-md h-96 border-second focus:border-seventh focus:ring-seventh"
                id="body">@if (isset($post)){{ old('body', $post->body) }}@else{{ old('body') }}@endif</textarea>
        </div>

        <div class="mt-16 mb-20">
            @include('components.preview')
        </div>

        <button type="submit"
            class="my-12 w-full bg-black text-white text-sm md:text-base rounded-full border border-seventh cursor-pointer hover:shadow-lg transition duration-300 ease-in-out">
            <div class="flex items-center justify-center">
                <i class="fa-solid fa-pen-fancy"></i>
                <p class="ml-2">記録する</p>
            </div>
        </button>

        </form>
    </div>
</div>

@if (!isset($errors) || count($errors) === 0)
    <script>
        window.onload = function () {
            const created_at_param = new URLSearchParams(window.location.search).get('created_at');
            let today = created_at_param ? new Date(created_at_param) : new Date();

            let yyyy = today.getFullYear();
            let mm = ("0" + (today.getMonth() + 1)).slice(-2);
            let dd = ("0" + today.getDate()).slice(-2);

            document.getElementById("today").value = yyyy + '-' + mm + '-' + dd;
        }
    </script>
@endif
