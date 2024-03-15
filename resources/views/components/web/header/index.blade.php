<x-web.header.top-navigation-bar />
<nav class="2xl:container relative mx-auto py-5 px-4 flex items-center font-bold gap-4">
    <button type="button" id="toggleMenu" class="bg-orange-200 hover:bg-orange-500 rounded-md border-orange-500 text-orange-500 hover:text-white px-1.5 py-1 transition-colors duration-300 flex justify-center items-center md:hidden " title="Menu Toggle Button">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
        </svg>
    </button>
    <a wire:navigate href="{{ route('home') }}" title="{{ config('app.name') }}" class="h-20 aspect-auto">
        <img src="{{ asset(config('app.logo')) }}" alt="{{ config('app.name') . ' Logo' }}" class="h-full w-full">
    </a>
    <menu class="ml-auto hidden md:block absolute md:static top-full left-0 w-full md:w-fit" id="menu">
        <ul class="flex md:flex-row flex-col  md:divide-x-2 divide-y-2 md:divide-y-0 md:shadow-none shadow-md bg-white">
            <li class="px-4 py-2">
                <a wire:navigate href="{{ route('home') }}" class=" hover:text-orange-500 flex {{ request()->is('/') ? 'text-orange-500' : '' }}">{{ __('Home') }}</a>
            </li>
            <li class="px-4 py-2">
                <a href="#" class=" hover:text-orange-500 flex {{ request()->is('home') ? 'text-orange-500' : '' }}">{{ __('Brands') }}</a>
            </li>
            <li class="px-4 py-2">
                <a href="#" class=" hover:text-orange-500 flex {{ request()->is('home') ? 'text-orange-500' : '' }}">{{ __('Products') }}</a>
            </li>
            <li class="px-4 py-2">
                <a href="#" class=" hover:text-orange-500 flex {{ request()->is('home') ? 'text-orange-500' : '' }}">{{ __('Contact Us') }}</a>
            </li>
        </ul>
    </menu>
    <ul class="flex justify-center items-center gap-5 ms-auto">
        <li>
            <a href="javascript:void(0)" class="flex justify-center items-center hover:text-orange-500 relative" title="My Cart">
                <svg width="36" height="36" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                <span class=" absolute flex justify-center items-center -top-3 -right-2 bg-orange-500 text-white rounded-full p-1 text-[10px] w-auto aspect-square">{{ __('10') }}</span>
            </a>
        </li>
        <li class="mr-2">
            <a href="javascript:void(0)" class="flex justify-center items-center hover:text-orange-500 relative" title="Wishlist">
                <svg width="36" height="36" fill="currentColor" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                </svg>
                <span class=" absolute flex justify-center items-center -top-3 -right-2 bg-orange-500 text-white rounded-full p-1 text-[10px] w-auto aspect-square">{{ __('10') }}</span>
            </a>
        </li>
    </ul>
</nav>
<x-web.header.navigation-bar />
@push('scripts')
    <script type="text/javascript">
        function toggleMenu() {
            if (window.innerWidth > 768) {
                document.getElementById('menu').style.display = "block";
            } else {
                document.getElementById('menu').style.display = "none";
            }
        }
        toggleMenu();
        window.addEventListener("resize", function() {
            toggleMenu();
        });
        document.getElementById('toggleMenu').addEventListener("click", function(e) {
            e.preventDefault();
            var menu = document.getElementById('menu');
            if (menu.style.display === "none" || menu.style.display === "") {
                menu.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        });
    </script>
@endpush
