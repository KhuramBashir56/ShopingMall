<x-slot name="title">
    {{ __('Available Stock') }}
</x-slot>
<section class="grid gap-4">
    <x-ui.alert-messages />
    <x-panel.ui.page-header>
        <div class="flex gap-4 flex-wrap">
            <x-ui.links.primary href="{{ route('admin.stock-management.new-stock') }}" title="Add New Stock" />
            <x-ui.links.primary href="{{ route('admin.stock-management.history') }}" title="View Stock History" />
        </div>
        <x-ui.form.input-search wire:model.live="search" placeholder="Search Brands..." />
    </x-panel.ui.page-header>
    @if ($stock->count() < 1)
        <h3 class="text-4xl text-gray-700">Record Not Found...</h3>
    @else
        <x-ui.table.table>
            <x-ui.table.thead>
                <x-ui.table.th :content="__('sr#')" />
                <x-ui.table.th :content="__('Thumbnail')" />
                <x-ui.table.th :content="__('Product Name')" />
                <x-ui.table.th :content="__('quantity')" />
                <x-ui.table.th :content="__('purchase')" />
                <x-ui.table.th :content="__('whole sale')" />
                <x-ui.table.th :content="__('retail sale')" />
                <x-ui.table.th :content="__('Availability')" class="text-center" />
                <x-ui.table.th :content="__('action')" class="text-center" />
            </x-ui.table.thead>
            <x-ui.table.tbody>
                @foreach ($stock as $index => $data)
                    <x-ui.table.tr>
                        <x-ui.table.td :content="$index + 1" />
                        <x-ui.table.td>
                            <img src="{{ asset(config('app.img_url') . $data->thumbnail) }}" alt="{{ $data->name . 'thumbnail image' }}" class="w-16 aspect-square">
                        </x-ui.table.td>
                        <x-ui.table.td :content="$data->name" />
                        <x-ui.table.td :content="$data->stock->sum('quantity') . ' (' . $data->unit->code . ')'" />
                        <x-ui.table.td :content="$data->price->purchase" class="text-center" />
                        <x-ui.table.td :content="$data->price->wholesale" class="text-center" />
                        <x-ui.table.td :content="$data->price->retail" class="text-center" />
                        <x-ui.table.td>
                            @if ($data->stock->sum('quantity') > 0)
                                <x-ui.badges.success :content="__('Available')" />
                            @else
                                <x-ui.badges.danger :content="__('Not Available')" />
                            @endif
                        </x-ui.table.td>
                        <x-ui.table.td class="text-center">
                            <x-ui.buttons.primary wire:click="changePrice({{ $data->id }})" :title="__('Change Price')" />
                        </x-ui.table.td>
                    </x-ui.table.tr>
                @endforeach
            </x-ui.table.tbody>
        </x-ui.table.table>
    @endif

    {{ $stock->links('components.ui.table.pagination') }}

    @if ($changePriceForm)
        <livewire:panel.admin.stock-management.change-price :$product />
    @endif
</section>
