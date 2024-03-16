<x-slot name="title">
    {{ __('Edit Unit Information') }}
</x-slot>
<section class="grid gap-4">
    <x-panel.ui.page-header>
        <x-ui.links.primary href="{{ route('admin.stock-management.units.list') }}" title="Stock Units List" />
    </x-panel.ui.page-header>
    <x-panel.ui.card>
        <div class="grid md:grid-cols-2 gap-x-6 w-full">
            <x-ui.form.label :title="__('Unit Title')" :for="__('title')">
                <x-ui.form.input type="text" wire:model='title' :for="__('title')" placeholder="Unit title goes here..." maxlength="24" />
                @error('title')
                    <x-ui.form.input-error :message="$message" />
                @enderror
            </x-ui.form.label>

            <x-ui.form.label :title="__('Unit Code')" :for="__('code')">
                <x-ui.form.input type="text" wire:model='code' :for="__('code')" placeholder="Unit code goes here..." maxlength="24" />
                @error('code')
                    <x-ui.form.input-error :message="$message" />
                @enderror
            </x-ui.form.label>

            <div class="md:col-span-2">
                <x-ui.form.label :title="__('Brand Description')" :for="__('description')">
                    <x-ui.form.textarea wire:model='description' :for="__('description')" placeholder="Brand description goes here..." maxlength="500" />
                    @error('description')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                </x-ui.form.label>

                <div class="flex items-center justify-end gap-x-3">
                    <x-ui.buttons.danger wire:click="cancel" type="button" title="Cancel" />
                    <x-ui.buttons.success wire:click="update({{ $unit_id }})" type="button" :title="__('Update')" />
                </div>
            </div>
        </div>
    </x-panel.ui.card>
</section>
