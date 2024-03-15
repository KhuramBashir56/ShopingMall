<x-slot name="title">
    {{ __($category->title) }}
</x-slot>
<x-slot name="description">
    {{ $category->meta_description }}
</x-slot>
<x-slot name="keywords">
    {{ $category->meta_keywords }}
</x-slot>
<section class="grid gap-4">
    <x-panel.ui.page-header>
        <div class="flex gap-4 flex-wrap">
            <x-ui.links.primary href="{{ route('admin.categories.list') }}" title="View Categories List" />
            <x-ui.links.primary href="{{ route('admin.categories.create') }}" title="Create New Category" />
        </div>
    </x-panel.ui.page-header>
    <x-panel.ui.card>
        <div class="w-full flex gap-4">
            <div class="w-full sm:w-1/2 lg:w-1/3 aspect-square flex-col sm:flex-row">
                <img src="{{ asset(config('app.img_url') . $category->thumbnail) }}" alt="{{ $category->title . 'thumbnail image' }}" class="w-full h-full">
            </div>
            <div class="w-full sm:w-1/2 lg:w-2/3">
                <x-ui.table.table>
                    <x-ui.table.tbody>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Category Author')" class="text-left" />
                            <x-ui.table.td :content="$category->author->name" />
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Date')" class="text-left" />
                            <x-ui.table.td :content="$category->created_at->format('d M, Y h:i A')" />
                        </x-ui.table.tr>
                        <x-ui.table.tr>
                            <x-ui.table.th :content="__('Visibility')" class="text-left" />
                            <x-ui.table.td>
                                @if ($category->status == 'published')
                                    <x-ui.badges.success :content="__('Visible')" />
                                @else
                                    <x-ui.badges.danger :content="__('Un Visible')" />
                                @endif
                            </x-ui.table.td>
                        </x-ui.table.tr>
                    </x-ui.table.tbody>
                </x-ui.table.table>
            </div>
        </div>
        <div class="w-full mt-4">
            <h1 class="text-3xl mb-3">{{ $category->title }}</h1>
            <p class="mb-3"><strong>Description: </strong> {{ $category->description }}</p>
            <div class="mb-3">
                <div class="flex gap-2 flex-wrap">
                    <strong>Meta Keyeords: </strong>
                    @foreach (explode(',', $category->meta_keywords) as $data)
                        <x-ui.badges.primary :content="$data" />
                    @endforeach
                </div>
            </div>
            <p class="mb-3"><strong>Meta Description: </strong> {{ $category->meta_description }}</p>
        </div>
    </x-panel.ui.card>
</section>
