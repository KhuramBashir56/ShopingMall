@props(['title', 'active', 'icon'])
<li class="nav border-l-4  {{ request()->is(explode(' ', $active)) ? 'border-orange-600 text-orange-600 bg-gray-50' : 'border-transparent text-white hover:bg-orange-500' }}">
    <a class="flex items-center px-4 py-3 w-full text-sm font-semibold transition-colors duration-150" wire:navigate {!! $attributes !!}>
        <span class="material-symbols-outlined">{{ $icon }}</span>
        <span class="ml-2">{{ $title }}</span>
    </a>
</li>
