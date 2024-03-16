<x-slot name="title">
    {{ __('Stock History') }}
</x-slot>
<section class="grid gap-4">
    <x-ui.alert-messages />
    <x-panel.ui.page-header>
        <x-ui.links.primary href="{{ route('admin.stock-management.new-stock') }}" title="Add New Stock" />
        <x-ui.form.input-search wire:model.live="search" placeholder="Search Brands..." />
    </x-panel.ui.page-header>
</section>
