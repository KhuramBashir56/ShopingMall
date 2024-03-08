@props(['content'])
<td {!! $attributes !!} class="p-3 text-sm">
    {{ $content ?? $slot }}
</td>
