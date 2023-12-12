@section('title', '記念日の日記')

<div class="bg-third py-12 px-6 mb-6">
    <div class="flex justify-between">
        <form id="searchForm" action="{{ route('likes') }}" method="GET" class="mx-auto">
            <input type="search" name="search" id="autoComplete"
                class="mx-auto ml-8 text-sm focus:border-transparent focus:ring-seventh focus:ring-offset-1 focus:ring-offset-seventh"
                value="@if (isset($search)) {{ $search }} @endif">
            <button class="text-white ml-1 cursor-pointer hover:scale-110 transition duration-150">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

        <div class="inline-flex items-center">
            <a href="{{ route('post.index') }}">
                <button type="submit" class="text-seventh">
                    <i class="fa-solid fa-arrow-rotate-left fa-lg"></i>
                </button>
            </a>
        </div>
    </div>
</div>

<div class="pb-6">
    {{ $posts->appends(request()->input())->links() }}
</div>

@include('components.autoCompletejs')
