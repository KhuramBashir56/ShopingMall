@props(['title', 'active'])
<li>
    <a class="nav w-full block pl-12 py-4 transition-colors duration-150 hover:text-orange-500 {{ request()->is(explode(' ', $active)) ? 'bg-gray-50 text-orange-500' : 'text-gray-800' }}" wire:navigate {{ $attributes }}>{{ $title }}</a>
</li>
