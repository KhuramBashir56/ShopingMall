@if ($paginator->hasPages())
    <div class="flex px-3 py-1.5 -mt-4 justify-between items-center text-gray-500 uppercase bg-gray-50 sm:grid-cols-9 border-t-2">
        <div class="flex justify-between w-full lg:hidden">
            @if ($paginator->onFirstPage())
                <button type="button" disabled class="py-1 px3 flex justify-center items-center rounded-md cursor-not-allowed rounded-l-lg focus:outline-none focus:shadow-outline-orange" aria-label="Previous">
                    <span class="material-symbols-outlined">
                        first_page
                    </span>
                    Previous
                </button>
            @else
                <button type="button" wire:click="previousPage" wire:loading.attr="disabled" class="py-1  px-3 flex justify-center items-center rounded-md rounded-r-lg text-gray-100 focus:outline-none focus:shadow-outline-orange bg-orange-500 hover:bg-orange-600" aria-label="Previous">
                    <span class="material-symbols-outlined">
                        keyboard_double_arrow_left
                    </span>
                    Previous
                </button>
            @endif
            @if ($paginator->hasMorePages())
                <button type="button" wire:click="nextPage" wire:loading.attr="disabled" class="py-1  px-3 flex justify-center items-center rounded-md rounded-r-lg text-gray-100 focus:outline-none focus:shadow-outline-orange bg-orange-500 hover:bg-orange-600" aria-label="Next">
                    Next
                    <span class="material-symbols-outlined">
                        keyboard_double_arrow_right
                    </span>
                </button>
            @else
                <button type="button" disabled class="py-1 px3 flex justify-center items-center cursor-not-allowed rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-orange" aria-label="Next">
                    Next
                    <span class="material-symbols-outlined">
                        last_page
                    </span>
                </button>
            @endif
        </div>

        <div class="lg:block hidden">
            {!! __('Showing') !!}
            @if ($paginator->firstItem())
                {{ $paginator->firstItem() }}
                {!! __('to') !!}
                {{ $paginator->lastItem() }}
            @else
                {{ $paginator->count() }}
            @endif
            {!! __('of') !!}
            {{ $paginator->total() }}
        </div>

        <ul class="lg:flex hidden items-center gap-1">
            <li>
                @if ($paginator->onFirstPage())
                    <button type="button" disabled class="p-2 rounded-md cursor-not-allowed rounded-l-lg focus:outline-none focus:shadow-outline-orange" aria-label="Previous">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                @else
                    <button type="button" wire:click="previousPage" wire:loading.attr="disabled" class="p-2 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-orange hover:bg-orange-500 hover:bg-opacity-20" aria-label="Previous">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                @endif
            </li>
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="px-3 font-extrabold">{{ $element }}</span>
                    </li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <button type="button" disabled class="px-3 py-1 cursor-not-allowed text-white transition-colors duration-150 bg-orange-500 border border-r-0 border-orange-500 rounded-md focus:outline-none focus:shadow-outline-orange">
                                    {{ $page }}
                                </button>
                            </li>
                        @else
                            <li>
                                <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-orange hover:bg-orange-500 hover:bg-opacity-20">
                                    {{ $page }}
                                </button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <li>
                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage" wire:loading.attr="disabled" class="p-2 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-orange hover:bg-orange-500 hover:bg-opacity-20" aria-label="Next">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                @else
                    <button type="button" disabled class="p-2 cursor-not-allowed rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-orange" aria-label="Next">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                @endif
            </li>
        </ul>
    </div>
@endif
