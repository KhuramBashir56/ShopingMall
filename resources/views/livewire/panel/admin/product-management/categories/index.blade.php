<x-slot name="title">
    {{ __('Categories List') }}
</x-slot>
<section class="grid gap-4">
    <x-ui.alert-messages />
    <x-ui.table.header>
        <x-ui.links.primary href="{{ route('admin.categories.create') }}" title="Create New Category" />
        <x-ui.form.input-search wire:model.live="search" placeholder="Search Categories..." />
    </x-ui.table.header>
    @if ($categories->count() < 1)
        <h3 class="text-4xl text-gray-700">Record Not Found...</h3>
    @else
        <x-ui.table.table>
            <x-ui.table.thead>
                <x-ui.table.th :content="__('sr#')" />
                <x-ui.table.th :content="__('Thumbnail')" />
                <x-ui.table.th :content="__('Category')" />
                <x-ui.table.th :content="__('Visibility')" class="text-center" />
                <x-ui.table.th :content="__('action')" class="text-center" />
            </x-ui.table.thead>
            <x-ui.table.tbody>
                @foreach ($categories as $index => $data)
                    <x-ui.table.tr wire:key="{{ $data->id }}">
                        <x-ui.table.td :content="$index + 1" />
                        <x-ui.table.td>
                            <img src="{{ asset(config('app.img_url') . $data->thumbnail) }}" alt="{{ $data->title . 'thumbnail image' }}" class="w-16 aspect-square">
                        </x-ui.table.td>
                        <x-ui.table.td :content="$data->title" />
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
                                    <x-ui.table.action-button wire:click='unVisible({{ $data->id }})' wire:confirm="Are you sure, you want to make category status as Un Visible?" :title="__('Un Visible')" :icon="__('visibility_off')" />
                                @else
                                    <x-ui.table.action-button wire:click='visible({{ $data->id }})' :title="__('Visible')" wire:confirm="Are you sure, you want to make category status as Visible?" :icon="__('visibility')" />
                                @endif
                                <x-ui.table.action-button wire:click='delete({{ $data->id }})' wire:confirm="Are you sure, you want to delete &quot;{{ $data->title }}&quot; category?" :title="__('Delete')" :icon="__('delete')" />
                            </x-ui.table.actions>
                        </x-ui.table.td>
                    </x-ui.table.tr>
                @endforeach
            </x-ui.table.tbody>
        </x-ui.table.table>
    @endif
    {{ $categories->links('components.ui.table.pagination') }}
</section>
