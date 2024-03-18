<x-slot name="title">
    {{ __('Stock History') }}
</x-slot>
<section class="grid gap-4">
    <x-ui.alert-messages />
    <x-panel.ui.page-header>
        <samp></samp>
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
                <x-ui.table.th :content="__('purchase price')" />
                <x-ui.table.th :content="__('whole sale price')" />
                <x-ui.table.th :content="__('retail sale price')" />
            </x-ui.table.thead>
            <x-ui.table.tbody>
                @foreach ($stock as $index => $data)
                    <x-ui.table.tr>
                        <x-ui.table.td :content="$index + 1" />
                        <x-ui.table.td>
                            <img src="{{ asset(config('app.img_url') . $data->thumbnail) }}" alt="{{ $data->name . 'thumbnail image' }}" class="w-16 aspect-square">
                        </x-ui.table.td>
                        <x-ui.table.td :content="$data->name" />
                        <x-ui.table.td :content="$data->stock->sum('quantity') . ' (' . $data->stock->unit . ')'" />
                        <x-ui.table.td :content="$data->price->purchase" />
                        <x-ui.table.td :content="$data->price->wholesale" />
                        <x-ui.table.td :content="$data->price->retail" />
                    </x-ui.table.tr>
                @endforeach
            </x-ui.table.tbody>
        </x-ui.table.table>
    @endif

    {{ $stock->links('components.ui.table.pagination') }}

</section>
