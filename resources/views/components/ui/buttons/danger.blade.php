@props(['title'])
<button {!! $attributes !!} wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:offline.attr="disabled" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-5 py-2.5" title="{{ $title }}">
    {{ $title }}
</button>
