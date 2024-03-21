<x-slot name="title">
    {{ __('Stock Details') }}
</x-slot>
<section class="grid gap-4">
    <x-panel.ui.page-header>
        <div class="flex gap-4 flex-wrap">
            <x-ui.links.primary href="{{ route('admin.stock-management.new-stock') }}" title="Add New Stock" />
            <x-ui.links.primary href="{{ route('admin.stock-management.history') }}" title="View Stock History" />
            <x-ui.links.primary href="{{ route('admin.stock-management.available-stock') }}" title="View Available Stock" />
        </div>
    </x-panel.ui.page-header>
    <x-panel.ui.card>
        <div class="w-full grid gap-4 grid-cols-1 md:grid-cols-3">
            <div class="aspect-square">
                <img src="{{ asset(config('app.img_url') . $stock->product->thumbnail) }}" alt="{{ $stock->product->title . 'thumbnail image' }}" class="w-full h-full">
            </div>
            <div class="md:order-none order-1 md:col-span-2">
                <x-ui.table.table>
                    <x-ui.table.tbody>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Stock Supplier Name')" class="text-left" />
                            <x-ui.table.td :content="$stock->supplier_name" />
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Stock Supply Invoice#')" class="text-left" />
                            <x-ui.table.td :content="$stock->invoice_Id" />
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Stock Supply Date')" class="text-left" />
                            <x-ui.table.td :content="$stock->supplied_at->format('d M, Y')" />
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Purchase Price')" class="text-left" />
                            <x-ui.table.td :content="$stock->price->purchase" />
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Quantity')" class="text-left" />
                            <x-ui.table.td :content="$stock->quantity" />
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Stock Expiry')" class="text-left" />
                            <x-ui.table.td :content="$stock->expiry_date->format('d M, Y')" />
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Status')" class="text-left" />
                            <x-ui.table.td>
                                @if ($stock->status == 'verified')
                                    <x-ui.badges.success :content="__('Verified')" />
                                @else
                                    <x-ui.badges.danger :content="__('Un Verified')" />
                                @endif
                            </x-ui.table.td>
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Stock Add Date')" class="text-left" />
                            <x-ui.table.td :content="$stock->created_at->format('d M, Y h:i A')" />
                        </x-ui.table.tr>
                    </x-ui.table.tbody>
                </x-ui.table.table>
            </div>
            <h1 class="text-3xl md-3 md:col-span-3">{{ $stock->product->name }}</h1>
            <p class="mb-3 md:order-none order-2 md:col-span-3"><strong>Remarks: </strong> {{ $stock->remarks }}</p>
        </div>
    </x-panel.ui.card>
</section>
