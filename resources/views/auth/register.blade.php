<x-layouts.web>
    <x-slot name="title">
        {{ __('Register') }}
    </x-slot>
    <header class="h-52 bg-contain bg-center flex justify-center items-center" style="background: url({{ asset('assets/images/guest/backgrounds/register.webp') }})">
        <h1 class="text-6xl font-bold w-fit my-8 mx-auto"> {{ __('Register') }}</h1>
    </header>
    <section class="xl:container mx-auto my-8">
        <div class=" max-w-md mx-auto border px-4 py-4 shadow-md rounded-md">
            <h3 class="text-orange-500 text-center mb-4">{{ __('Please fill out the form to register your account.') }}</h3>
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <x-ui.form.label :title="__('Name')" :for="__('name')">
                    <x-ui.form.input type="text" value="{{ old('name') }}" :for="__('name')" placeholder="Enter Your Full Name" maxlength="48" required autofocus autocomplete="name" />
                    @error('name')
                        <x-ui.form.input-error :message="$message" class="mt-2" />
                    @enderror
                </x-ui.form.label>
                <x-ui.form.label :title="__('Email')" :for="__('email')">
                    <x-ui.form.input type="email" value="{{ old('email') }}" :for="__('email')" placeholder="example@xyz.com" maxlength="60" required autocomplete="username" />
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
                <x-ui.form.label :title="__('Confirm Password')" :for="__('password_confirmation')">
                    <x-ui.form.input type="password" :for="__('password_confirmation')" placeholder="********" minlength="8" maxlength="32" required autocomplete="new-password" />
                    @error('password_confirmation')
                        <x-ui.form.input-error :message="$message" class="mt-2" />
                    @enderror
                </x-ui.form.label>
                <label for="terms" class="flex items-center justify-between mt-4 text-sm text-gray-800">
                    <span class="block">
                        <x-ui.form.check-box :for="__('terms')" required />
                        {{ __('I accept the') }}
                        <a wire:navigate class="underline hover:text-orange-500" href="#">
                            {{ __('terms and conditions') }}
                        </a>
                    </span>
                    @error('terms')
                        <x-ui.form.input-error :message="$message" class="mt-2" />
                    @enderror
                </label>
                <div class="flex justify-center mt-4">
                    <x-ui.buttons.primary type="submit" :title="__('Register')" />
                </div>
            </form>
            <a wire:navigate href="{{ route('login.index') }}" class="underline text-sm text-gray-800 hover:text-orange-500 w-fit block mx-auto mt-4">
                {{ __('Already Registered?') }}
            </a>
        </div>
    </section>
</x-layouts.web>
