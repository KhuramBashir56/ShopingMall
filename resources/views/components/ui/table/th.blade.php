@props(['content'])
<th {!! $attributes !!} class="p-3 text-xs">{{ $content ?? $slot }}</th>
