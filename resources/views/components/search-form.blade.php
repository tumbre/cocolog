@section('title', 'すべての日記')

<div class="bg-third py-12 px-6 mb-6">
    <div class="flex justify-between">
        <form id="searchForm" action="{{ route('post.index') }}" method="GET" class="mx-auto">
            <input type="search" name="search" id="autoComplete"
                class="text-sm ml-8 focus:border-transparent focus:ring-seventh focus:ring-offset-1 focus:ring-offset-seventh"
                value="@if (isset($search)) {{ $search }} @endif">
            <button class="text-white ml-1 cursor-pointer hover:scale-110 transition duration-150">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

        <div class="inline-flex items-center">
            <a href="{{ route('likes') }}">
                <button type="submit" class="text-seventh">
                    <i class="fas fa-heart fa-lg"></i>
                </button>
            </a>
        </div>
    </div>
</div>

<div class="pb-6">
    {{ $posts->appends(request()->input())->links() }}
</div>

@include('components.autoCompletejs')