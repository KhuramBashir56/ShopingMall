@props(['title'])
<button {!! $attributes !!} wire:loading.attr="disabled" wire:offline.attr="disabled" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5" title="{{ $title }}">
    {{ $title }}
</button>
