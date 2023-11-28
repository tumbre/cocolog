<script src="{{ asset('/js/preview.js') }}"></script>

<div id="image-preview-container">
    <label for="image" class="font-semibold leading-none mt-6 mb-2">画像（1MBまで） </label>
    <label id="add-image-button"
        class="mt-2 mb-4 bg-white rounded-full flex justify-center items-center border border-gray-400 hover:shadow-lg transition duration-300 ease-in-out cursor-pointer">
        <i class="fa-solid fa-camera"></i>
        <span class="ml-2 text-sm md:text-base">写真を選択する</span>
        <input id="image" type="file" name="image" class="hidden" multiple onchange="showPreview(event)">
    </label>
    <div id="image-preview"></div>
    @isset($post)
        @if ($post->image)
            <div class="preview-image-wrapper relative">
                @if (app()->isLocal())
                    <img src="{{ asset('storage/images/' . $post->image) }}" id="existing-image"
                        class="rounded-md mt-4 w-full";>
                @else
                    <img id="existing-image" class="rounded-md mt-4 w-full" src="{{ $post->image }}">
                @endif
                <!-- 削除機能は後で実装 -->
                <i id="remove-icon"
                    class="fa-solid fa-circle-xmark fa-2xl remove-image absolute top-2 right-0 p-4 text-third cursor-pointer"></i>
            </div>
        @endif
    @endisset
</div>
