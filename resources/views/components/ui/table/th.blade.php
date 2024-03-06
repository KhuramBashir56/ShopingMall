@props(['content'])
<th {{ $attributes }} class="px-4 py-2 text-xs">{{ $content ?? $slot }}</th>
