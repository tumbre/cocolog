<div class="flex flex-col justify-center pb-6 sm:pb-12 lg:pb-14 text-center">
    <form action="{{ route('post.index') }}" method="GET">
        <input type="search" name="search"
            class="w-60 rounded-full text-sm border-second focus:border-seventh focus:ring-seventh" placeholder="タイトル/本文"
            value="@if (isset($search)) {{ $search }} @endif">
        <input type="submit" value="検索" class="cursor-pointer hover:scale-105">
    </form>
</div>

<div class="pb-6">
    {{ $posts->appends(request()->input())->links() }}
</div>
