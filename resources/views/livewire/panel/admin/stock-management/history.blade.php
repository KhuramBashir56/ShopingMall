<x-slot name="title">
    {{ __('Stock History') }}
</x-slot>
<section class="grid gap-4">
    <x-ui.alert-messages />
    <x-panel.ui.page-header>
        <x-ui.links.primary href="{{ route('admin.stock-management.new-stock') }}" title="Add New Stock" />
        <x-ui.form.input-search wire:model.live="search" placeholder="Search Brands..." />
    </x-panel.ui.page-header>
    @if ($history->count() < 1)
        <h3 class="text-4xl text-gray-700">Record Not Found...</h3>
    @else
        <x-ui.table.table>
            <x-ui.table.thead>
                <x-ui.table.th :content="__('sr#')" />
                <x-ui.table.th :content="__('Thumbnail')" />
                <x-ui.table.th :content="__('Product Name')" />
                <x-ui.table.th :content="__('quantity')" />
                <x-ui.table.th :content="__('Purchase Price')" />
                <x-ui.table.th :content="__('Whole Sale Price')" />
                <x-ui.table.th :content="__('Retail Sale Price')" />
                <x-ui.table.th :content="__('Status')" class="text-center" />
                <x-ui.table.th :content="__('action')" class="text-center" />
            </x-ui.table.thead>
            <x-ui.table.tbody>
                @foreach ($history as $index => $data)
                    <x-ui.table.tr>
                        <x-ui.table.td :content="$index + 1" />
                        <x-ui.table.td>
                            <img src="{{ asset(config('app.img_url') . $data->product->thumbnail) }}" alt="{{ $data->product->name . 'thumbnail image' }}" class="w-16 aspect-square">
                        </x-ui.table.td>
                        <x-ui.table.td :content="$data->product->name" />
                        <x-ui.table.td :content="$data->quantity . ' (' . $data->unit->code . ')'" />
                        <x-ui.table.td :content="$data->price->purchase" />
                        <x-ui.table.td :content="$data->price->wholesale" />
                        <x-ui.table.td :content="$data->price->retail" />
                        <x-ui.table.td class="text-center">
                            @if ($data->status == 'verified')
                                <x-ui.badges.success :content="__('Verified')" />
                            @else
                                <x-ui.badges.danger :content="__('Unverified')" />
                            @endif
                        </x-ui.table.td>
                        <x-ui.table.td class="text-center">
                            <x-ui.table.actions>
                                <x-ui.table.action-button wire:click='details({{ $data->id }})' :title="__('View Details')" :icon="__('info')" />
                                @if ($data->status == 'unverified')
                                    <x-ui.table.action-button wire:click='invisible({{ $data->id }})' wire:confirm="Are you sure, you want to make brand status as Invisible?" :title="__('Invisible')" :icon="__('assignment_turned_in')" />
                                @endif
                            </x-ui.table.actions>
                        </x-ui.table.td>
                    </x-ui.table.tr>
                @endforeach
            </x-ui.table.tbody>
        </x-ui.table.table>
    @endif

    {{ $history->links('components.ui.table.pagination') }}

</section>
