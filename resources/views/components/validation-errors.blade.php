@props(['errors'])

@if ($errors->any())
  <div {{ $attributes }}>
    <div class="text-start font-semibold">エラーが発生しました..😞</div>

    <ul class="mt-3 mb-12 list-disc list-inside text-sm text-start">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif