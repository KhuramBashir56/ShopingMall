<x-slot name="title">
    {{ __('Add New Stock') }}
</x-slot>
<section class="grid gap-4">
    <x-ui.alert-messages />
    <x-panel.ui.page-header>
        <x-ui.links.primary href="{{ route('admin.stock-management.history') }}" title="Stock History" />
    </x-panel.ui.page-header>
    <x-panel.ui.card>
    </x-panel.ui.card>
</section>
