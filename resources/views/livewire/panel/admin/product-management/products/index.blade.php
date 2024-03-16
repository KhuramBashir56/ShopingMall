<x-slot name="title">
    {{ __('Products List') }}
</x-slot>
<section class="grid gap-4">
    <x-ui.alert-messages />
    <x-panel.ui.page-header>
        <x-ui.links.primary href="{{ route('admin.products.create') }}" title="Add New Product" />
        <x-ui.form.input-search wire:model.live="search" placeholder="Search Products..." />
    </x-panel.ui.page-header>
    @if ($products->count() < 1)
        <h3 class="text-4xl text-gray-700">Record Not Found...</h3>
    @else
        <x-ui.table.table>
            <x-ui.table.thead>
                <x-ui.table.th :content="__('sr#')" />
                <x-ui.table.th :content="__('Thumbnail')" />
                <x-ui.table.th :content="__('Product')" />
                <x-ui.table.th :content="__('Category')" />
                <x-ui.table.th :content="__('Brand')" />
                <x-ui.table.th :content="__('Visibility')" class="text-center" />
                <x-ui.table.th :content="__('action')" class="text-center" />
            </x-ui.table.thead>
            <x-ui.table.tbody>
                @foreach ($products as $index => $data)
                    <x-ui.table.tr wire:key="{{ $data->id }}">
                        <x-ui.table.td :content="$index + 1" />
                        <x-ui.table.td>
                            <img src="{{ asset(config('app.img_url') . $data->thumbnail) }}" alt="{{ $data->title . 'thumbnail image' }}" class="w-16 aspect-square">
                        </x-ui.table.td>
                        <x-ui.table.td :content="$data->name" />
                        <x-ui.table.td :content="$data->category->title" />
                        <x-ui.table.td :content="$data->brand->name" />
                        <x-ui.table.td class="text-center">
                            @if ($data->status == 'published')
                                <x-ui.badges.success :content="__('Visible')" />
                            @else
                                <x-ui.badges.danger :content="__('Invisible')" />
                            @endif
                        </x-ui.table.td>
                        <x-ui.table.td class="text-center">
                            <x-ui.table.actions>
                                <x-ui.table.action-button wire:click='details({{ $data->id }})' :title="__('View Details')" :icon="__('info')" />
                                <x-ui.table.action-button wire:click='edit({{ $data->id }})' :title="__('Edit')" :icon="__('edit_square')" />
                                @if ($data->status == 'published')
                                    <x-ui.table.action-button wire:click='invisible({{ $data->id }})' wire:confirm="Are you sure, you want to make product status as Invisible?" :title="__('Invisible')" :icon="__('visibility_off')" />
                                @else
                                    <x-ui.table.action-button wire:click='visible({{ $data->id }})' :title="__('Visible')" wire:confirm="Are you sure, you want to make product status as Visible?" :icon="__('visibility')" />
                                @endif
                                <x-ui.table.action-button wire:click='delete({{ $data->id }})' wire:confirm="Are you sure, you want to delete &quot;{{ $data->name }}&quot; product?" :title="__('Delete')" :icon="__('delete')" />
                            </x-ui.table.actions>
                        </x-ui.table.td>
                    </x-ui.table.tr>
                @endforeach
            </x-ui.table.tbody>
        </x-ui.table.table>
    @endif
    {{ $products->links('components.ui.table.pagination') }}
</section>
