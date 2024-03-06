@props(['title'])
<button {{ $attributes }} wire:loading.attr="disabled" wire:offline.attr="disabled" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-md text-sm px-5 py-2.5" title="{{ $title }}">
    {{ $title }}
</button>
