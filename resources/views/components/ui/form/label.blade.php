@props(['for', 'title'])
<div class="block w-full mb-3 text-md">
    <label class="text-gray-800" for="{{ $for }}" {{ $attributes }}>{{ $title }}</label>
    {{ $slot }}
</div>
