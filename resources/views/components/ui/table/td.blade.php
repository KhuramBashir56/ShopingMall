@props(['content'])
<td {!! $attributes !!} class="px-3 py-4 text-sm">
    {{ $content ?? $slot }}
</td>
