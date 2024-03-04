@props(['for', 'title'])
<div class="block mb-3 text-md" for="{{ $for }}">
    <label class="text-gray-800" {{ $attributes }}>{{ $title }}</label>
    {{ $slot }}
</div>
