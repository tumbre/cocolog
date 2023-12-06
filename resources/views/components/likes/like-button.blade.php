<script src="{{ asset('/js/like.js') }}"></script>

<form method="post" action="{{ route('like', ['post' => $post]) }}" class="like-form" data-button-id="{{ $post->id }}">
    @csrf
    <button type="submit" class="toggle_wish mr-auto">
        <i class="far fa-heart text-lg"></i>
    </button>
</form>

<form method="post" action="{{ route('unlike', ['post' => $post]) }}" class="unlike-form hidden" data-button-id="{{ $post->id }}">
    @csrf
    @method('delete')
    <button type="submit" class="toggle_wish mr-auto">
        <i class="fas fa-heart text-lg"></i>
    </button>
</form>