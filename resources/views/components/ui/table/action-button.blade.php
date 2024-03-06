@props(['title', 'icon'])
<button title="{{ $title }}" type="button" {{ $attributes }} class="flex items-center justify-between p-1 text-sm font-medium leading-5 text-orange-500 rounded-lg hover:bg-orange-500 hover:text-white cursor-pointer">
    <span class="material-symbols-outlined">{{ $icon }}</span>
</button>
