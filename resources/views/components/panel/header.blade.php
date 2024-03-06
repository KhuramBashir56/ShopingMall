<header class="z-40 py-4 bg-orange-500 shadow-md">
    <div class="flex items-center justify-between h-full px-6 mx-auto text-white">
        <div class="flex items-center">
            <a class="text-lg font-bold" href="{{ route('home') }}" title="{{ config('app.name') }} Logo">{{ config('app.name') }}</a>
            <button id="menu_bar_toggle_button" class="p-1 ms-3 rounded-md lg:hidden focus:outline-none focus:shadow-outline-purple" title="Toggle Menu Bar">
                <span class="material-symbols-outlined">{{ __('menu') }}</span>
            </button>
        </div>
        <ul x-data="{ user_menu: false }" class="flex items-center flex-shrink-0 space-x-6">
            <li class="relative">
                <button x-on:click="user_menu = ! user_menu" class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none">
                    <img class="object-cover w-8 h-8 rounded-full" loading="lazy" src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82" alt="" aria-hidden="true" />
                </button>
                <menu x-show="user_menu" style="display: none;">
                    <ul class="absolute right-0 w-56 mt-2 text-gray-600 bg-white border border-gray-100 divide-y-2 rounded-md shadow-md">
                        <li class="flex">
                            <a href="#" class="inline-flex items-center w-full px-3 gap-2 py-2 text-sm font-semibold transition-colors duration-150 hover:bg-orange-500 hover:text-white">
                                <span class="material-symbols-outlined">account_box</span>
                                <span>{{ __('My Profile') }}</span>
                            </a>
                        </li>
                        <li class="flex">
                            <a href="#" class="inline-flex items-center w-full px-3 gap-2 py-2 text-sm font-semibold transition-colors duration-150 hover:bg-orange-500 hover:text-white">
                                <span class="material-symbols-outlined">settings</span>
                                <span>{{ __('Account Settings') }}</span>
                            </a>
                        </li>
                        <li class="flex">
                            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="inline-flex items-center justify-center w-full px-3 gap-2 py-2 text-sm font-semibold transition-colors duration-150 hover:bg-red-500 hover:text-white" href="javascript:void(0)">
                                <span class="material-symbols-outlined">move_item</span>
                                <span>{{ __('Log out') }}</span>
                            </a>
                        </li>
                        <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </menu>
            </li>
        </ul>
    </div>
</header>
@push('scripts')
    <script type="text/javascript">
        var menuBarButton = document.getElementById('menu_bar_toggle_button');
        var menuBar = document.getElementById('menu_bar');
        menuBarButton.addEventListener('click', function() {
            menuBar.classList.toggle('-translate-x-full');
        });
        if (window.innerWidth < 768) {
            window.addEventListener('resize', function() {
                menuBar.classList.remove('-translate-x-full');
            });
        }
    </script>
@endpush
