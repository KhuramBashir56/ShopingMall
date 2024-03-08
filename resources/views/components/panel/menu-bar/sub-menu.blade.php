@props(['title', 'active', 'icon'])
<li class="main-item border-l-4  {{ request()->is(explode(' ', $active)) ? 'border-orange-600 text-white bg-orange-500' : 'border-transparent' }}">
    <button class="inline-flex px-4 py-3 items-center justify-between w-full text-sm font-semibold transition-colors duration-150 text-white hover:bg-orange-500 hover:text-white">
        <span class="inline-flex items-center">
            <span class="material-symbols-outlined">{{ $icon }}</span>
            <span class="ml-2">{{ $title }}</span>
        </span>
        <span class="arrow material-symbols-outlined transition-all duration-500 -rotate-90 {{ request()->is(explode(' ', $active)) ? 'rotate-0' : '' }}">expand_more</span>
    </button>
    <ul class="{{ request()->is(explode(' ', $active)) ? '' : 'hidden' }} sub-menu overflow-hidden text-sm font-medium text-gray-500 shadow-inner bg-orange-100">
        {{ $slot }}
    </ul>
</li>
