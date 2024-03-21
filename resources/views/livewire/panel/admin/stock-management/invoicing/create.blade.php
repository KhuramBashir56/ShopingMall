<x-slot name="title">
    {{ __('Create New Invoice') }}
</x-slot>
<section class="grid gap-4">
    <x-ui.alert-messages />
    <x-panel.ui.page-header>
        <div class="flex gap-4 flex-wrap">
            <x-ui.links.primary href="{{ route('admin.stock-management.invoicing.paid-invoices') }}" title="Paid Invoices" />
            <x-ui.links.primary href="{{ route('admin.stock-management.invoicing.pending-invoices') }}" title="Pending Invoices" />
        </div>
        <x-ui.form.input-search wire:model.live="search" placeholder="Search Brands..." />
    </x-panel.ui.page-header>
</section>
