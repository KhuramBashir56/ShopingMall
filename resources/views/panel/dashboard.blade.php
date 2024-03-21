<x-layouts.panel>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    @push('scripts')
        @livewireScripts
    @endpush
</x-layouts.panel>
