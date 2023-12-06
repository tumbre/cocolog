@section('title', 'すべての日記')

<div class="w-full bg-third py-12 px-6 mb-6">
    <div class="relative flex w-full">
        <nav class="items-center flex-grow pb-0 flex justify-end">
            <a class="px-2 py-2 text-sm text-gray-500 px-6 px-3 hover:text-blue-600 ml-auto" href="#"></a>
            <form action="{{ route('post.index') }}" method="GET" class="flex">
                <input type="search" name="search"
                class="w-40 sm:w-72 py-2 text-sm text-gray-500 hover:text-blue-600 ml-auto"
                placeholder="タイトル/本文"
                value="@if (isset($search)) {{ $search }}@endif">
                <input type="submit" value="Search" class="cursor-pointer hover:scale-105 text-white ml-1">
            </form>

            <div class="inline-flex items-center gap-2 list-none ml-auto">
                <div class="relative flex-shrink-0 ml-5">
                    <a href="{{ route('likes') }}">
                        <button type="submit">
                            <i class="fas fa-heart text-2xl text-sixth"></i>
                        </button>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>


<div class="pb-6">
    {{ $posts->appends(request()->input())->links() }}
</div>