<x-slot name="title">
    {{ __($unit->title) }}
</x-slot>
<section class="grid gap-4">
    <x-panel.ui.page-header>
        <div class="flex gap-4 flex-wrap">
            <x-ui.links.primary href="{{ route('admin.products.units.list') }}" title="View Units List" />
            <x-ui.links.primary href="{{ route('admin.products.units.create') }}" title="Add New Unit" />
        </div>
    </x-panel.ui.page-header>
    <x-panel.ui.card>
        <div class="w-full mt-4">
            <h1 class="text-3xl mb-3">{{ $unit->title }}</h1>
            <p class="mb-3"><strong>Shot Code: </strong> {{ $unit->code }}</p>
            <p class="mb-3"><strong>Description: </strong> {{ $unit->description }}</p>
            <p class="mb-3"><strong>Author Name: </strong> {{ $unit->author->name }}</p>
            <p class="mb-3"><strong>Crated At: </strong> {{ $unit->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </x-panel.ui.card>
</section>
