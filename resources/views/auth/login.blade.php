<x-layouts.web>
    <x-slot name="title">
        {{ __('Login') }}
    </x-slot>
    <header class="h-52 bg-contain bg-center flex justify-center items-center" style="background: url({{ asset('assets/images/guest/backgrounds/login.jpg') }})">
        <h1 class="text-6xl font-bold w-fit my-8 mx-auto">{{ __('Login') }}</h1>
    </header>
    <section class="xl:container mx-auto my-8">
        <div class=" max-w-md mx-auto border px-4 shadow-md rounded-md py-4">
            <h3 class="text-orange-500 text-center mb-4">{{ __('Please fill out the form to start a session.') }}</h3>
            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <x-ui.form.label :title="__('Email')" :for="__('email')">
                    <x-ui.form.input type="email" value="{{ old('email') }}" :for="__('email')" placeholder="example@xyz.com" maxlength="60" required autofocus autocomplete="username" />
                    @error('email')
                        <x-ui.form.input-error :message="$message" class="mt-2" />
                    @enderror
                </x-ui.form.label>
                <x-ui.form.label :title="__('Password')" :for="__('password')">
                    <x-ui.form.input type="password" :for="__('password')" placeholder="********" minlength="8" maxlength="32" required autocomplete="new-password" />
                    @error('password')
                        <x-ui.form.input-error :message="$message" class="mt-2" />
                    @enderror
                </x-ui.form.label>
                <div class="flex justify-between items-center mt-4 text-sm text-gray-800">
                    <label for="remember" class="flex items-center gap-1 ">
                        <x-ui.form.check-box :for="__('remember')" />
                        {{ __('Remember me') }}
                    </label>
                    <a wire:navigate href="#" class="underline hover:text-orange-500">{{ __('Forget Password') }}</a>
                </div>
                <div class="flex justify-center mt-4">
                    <x-ui.buttons.primary type="submit" :title="__('Login')" />
                </div>
            </form>
            <a wire:navigate class="underline text-sm text-gray-800 hover:text-orange-500 w-fit block mx-auto mt-4" href="{{ route('register.index') }}">
                {{ __('Not already registered?') }}
            </a>
        </div>
    </section>
</x-layouts.web>
