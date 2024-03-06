<section class="bg-gray-300">
    <div class="mx-auto 2xl:container flex">
        <ul class="ml-auto flex divide-x-2 divide-gray-950 gap-3 px-4 py-2">
            @guest
                <li>
                    <a wire:navigate href="{{ route('login.index') }}" class="flex items-center gap-1 hover:text-orange-500" title="Account Login">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                        </svg>
                        <span class="hidden sm:block">{{ __('Login') }}</span>
                    </a>
                </li>
                <li class="pl-2">
                    <a wire:navigate href="{{ route('register.index') }}" class="flex items-center gap-1 hover:text-orange-500" title="Register Account">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1" />
                            <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z" />
                        </svg>
                        <span class="hidden sm:block">{{ __('Register') }}</span>
                    </a>
                </li>
            @endguest
            @auth
                <li x-data="{ open: false }" class="pl-2 relative">
                    <a x-on:click="open = !open" href="javascript:void(0)" class="flex items-center gap-1 hover:text-orange-500" title="My Account">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                        <span class="hidden sm:block">{{ __('My Account') }}</span>
                    </a>
                    <ul x-show="open" class="absolute z-50 bg-white text-orange-500 shadow-md right-0 w-60 top-8 divide-y-2" style="display: none">
                        <div class="py-2 px-3 bg-orange-500 text-white">
                            <img src="{{ asset('assets/logo.png') }}" alt="{{ Auth::user()->name }} profile image" class="bg-white rounded-full w-20 aspect-square block mx-auto my-3">
                            <h3 class="font-bold">{{ Str::limit(Auth::user()->name, 20) }}</h3>
                            <p class="text-xs">{{ Auth::user()->email }}</p>
                            <div class="flex justify-between text-xs">
                                <span>{{ __('Account Balance: ') }}</span>
                                <span>{{ __('PKR =50000/-') }}</span>
                            </div>
                        </div>
                        @cannot('user')
                            <li>
                                <a href="{{ route('dashboard') }}" class="block py-2 px-3 hover:bg-orange-500 hover:text-white transition-colors duration-300">{{ __('My Dashboard') }}</a>
                            </li>
                        @endcannot
                        <li>
                            <a href="javascript:void(0)" class="block py-2 px-3 hover:bg-orange-500 hover:text-white transition-colors duration-300">{{ __('My Profile') }}</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="block py-2 px-3 hover:bg-orange-500 hover:text-white transition-colors duration-300">{{ __('My Cart') }}</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="block py-2 px-3 hover:bg-orange-500 hover:text-white transition-colors duration-300">{{ __('My Wish List') }}</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block py-2 px-3 hover:bg-red-500 text-center text-red-500 hover:text-white transition-colors duration-300">{{ __('Logout ') }}</a>
                        </li>
                    </ul>
                </li>
            @endauth
        </ul>
    </div>
</section>
<form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
