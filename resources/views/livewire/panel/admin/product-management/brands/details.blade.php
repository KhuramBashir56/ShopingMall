<x-slot name="title">
    {{ __($brand->title) }}
</x-slot>
<x-slot name="description">
    {{ $brand->meta_description }}
</x-slot>
<x-slot name="keywords">
    {{ $brand->meta_keywords }}
</x-slot>
<section class="grid gap-4">
    <x-panel.ui.page-header>
        <div class="flex gap-4 flex-wrap">
            <x-ui.links.primary href="{{ route('admin.brands.list') }}" title="View Brands List" />
            <x-ui.links.primary href="{{ route('admin.brands.create') }}" title="Add New Brand" />
        </div>
    </x-panel.ui.page-header>
    <x-panel.ui.card>
        <div class="w-full grid gap-4 grid-cols-1 md:grid-cols-3">
            <div class="aspect-square">
                <img src="{{ asset(config('app.img_url') . $brand->thumbnail) }}" alt="{{ $brand->title . 'thumbnail image' }}" class="w-full h-full">
            </div>
            <div class="md:order-none order-1 md:col-span-2">
                <x-ui.table.table>
                    <x-ui.table.tbody>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Brand Category')" class="text-left" />
                            <x-ui.table.td :content="$brand->category->title" />
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Brand Author')" class="text-left" />
                            <x-ui.table.td :content="$brand->author->name" />
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Date')" class="text-left" />
                            <x-ui.table.td :content="$brand->created_at->format('d M, Y h:i A')" />
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Visibility')" class="text-left" />
                            <x-ui.table.td>
                                @if ($brand->status == 'published')
                                    <x-ui.badges.success :content="__('Visible')" />
                                @else
                                    <x-ui.badges.danger :content="__('Un Visible')" />
                                @endif
                            </x-ui.table.td>
                        </x-ui.table.tr>
                    </x-ui.table.tbody>
                </x-ui.table.table>
            </div>
            <h1 class="text-3xl md-3 md:col-span-3">{{ $brand->name }}</h1>
            <p class="mb-3 mb-3 md:order-none order-2 md:col-span-3"><strong>Description: </strong> {{ $brand->description }}</p>
            <div class="mb-3 mb-3 md:order-none order-2 md:col-span-3">
                <div class="flex gap-2 flex-wrap">
                    <strong>Meta Keyeords: </strong>
                    @foreach (explode(',', $brand->meta_keywords) as $data)
                        <x-ui.badges.primary :content="$data" />
                    @endforeach
                </div>
            </div>
            <p class="mb-3 md:order-none order-2 md:col-span-3"><strong>Meta Description: </strong> {{ $brand->meta_description }}</p>
        </div>
    </x-panel.ui.card>
</section>
