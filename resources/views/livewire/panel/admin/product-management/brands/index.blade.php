<x-slot name="title">
    {{ __('Brands List') }}
</x-slot>
<section class="grid gap-4">
    <x-ui.alert-messages />
    <x-ui.table.header>
        <x-ui.links.primary href="{{ route('admin.brands.create') }}" title="Create New Brand" />
        <x-ui.form.input-search wire:model.live="search" placeholder="Search Brands..." />
    </x-ui.table.header>
    @if ($brands->count() < 1)
        <h3 class="text-4xl text-gray-700">Record Not Found...</h3>
    @else
        <x-ui.table.table>
            <x-ui.table.thead>
                <x-ui.table.th :content="__('sr#')" />
                <x-ui.table.th :content="__('Thumbnail')" />
                <x-ui.table.th :content="__('Brand Name')" />
                <x-ui.table.th :content="__('Category')" />
                <x-ui.table.th :content="__('visibility')" class="text-center" />
                <x-ui.table.th :content="__('action')" class="text-center" />
            </x-ui.table.thead>
            <x-ui.table.tbody>
                @foreach ($brands as $index => $data)
                    <x-ui.table.tr>
                        <x-ui.table.td :content="$index + 1" />
                        <x-ui.table.td>
                            <img src="{{ asset('storage/' . $data->thumbnail) }}" alt="{{ $data->name . 'thumbnail image' }}" class="w-16 aspect-square">
                        </x-ui.table.td>
                        <x-ui.table.td :content="$data->name" />
                        <x-ui.table.td :content="$data->category->title" />
                        <x-ui.table.td class="text-center">
                            @if ($data->status == 'published')
                                <x-ui.badges.success :content="__('Visible')" />
                            @else
                                <x-ui.badges.danger :content="__('Un Visible')" />
                            @endif
                        </x-ui.table.td>
                        <x-ui.table.td class="text-center">
                            <x-ui.table.actions>
                                <x-ui.table.action-button wire:click='details({{ $data->id }})' :title="__('View Details')" :icon="__('info')" />
                                @if ($data->status == 'published')
                                    <x-ui.table.action-button wire:click='unVisible({{ $data->id }})' wire:confirm="Are you sure, you want to make brand status as Un Visible?" :title="__('Un Visible')" :icon="__('visibility_off')" />
                                @else
                                    <x-ui.table.action-button wire:click='visible({{ $data->id }})' :title="__('Visible')" wire:confirm="Are you sure, you want to make brand status as Visible?" :icon="__('visibility')" />
                                @endif
                                <x-ui.table.action-button wire:click='delete({{ $data->id }})' wire:confirm="Are you sure, you want to delete &quot;{{ $data->name }}&quot; brand?" :title="__('Delete')" :icon="__('delete')" />
                            </x-ui.table.actions>
                        </x-ui.table.td>
                    </x-ui.table.tr>
                @endforeach
            </x-ui.table.tbody>
        </x-ui.table.table>
    @endif

    {{ $brands->links('components.ui.table.pagination') }}

</section>
