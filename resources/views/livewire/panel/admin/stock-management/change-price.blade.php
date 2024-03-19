<x-ui.modal.box :width="__('sm:max-w-sm')">
    <x-ui.modal.header>
        <p class="text-lg font-semibold text-center text-orange-500 uppercase">{{ __('Change Price') }}</p>
        <x-ui.modal.close-button wire:click="$parent.cancel" />
    </x-ui.modal.header>
    <x-ui.modal.body>
        <form wire:submit="updatePrice({{ $product_id }})">
            <x-ui.form.label :title="__('Purchase Price')" :for="__('purchase')">
                <x-ui.form.input type="number" wire:model='purchase' :for="__('purchase')" placeholder="Purchase Price goes here..." min="1" max="9999999" />
                @error('purchase')
                    <x-ui.form.input-error :message="$message" />
                @enderror
            </x-ui.form.label>

            <x-ui.form.label :title="__('Whole Sale Price')" :for="__('wholesale')">
                <x-ui.form.input type="number" wire:model='wholesale' :for="__('wholesale')" placeholder="Whole Sale Price goes here..." min="1" max="9999999" />
                @error('wholesale')
                    <x-ui.form.input-error :message="$message" />
                @enderror
            </x-ui.form.label>

            <x-ui.form.label :title="__('Retail Price')" :for="__('retail')">
                <x-ui.form.input type="number" wire:model='retail' :for="__('retail')" placeholder="Retail Price goes here..." min="1" max="9999999" />
                @error('price')
                    <x-ui.form.input-error :message="$message" />
                @enderror
            </x-ui.form.label>

            <div class="flex items-center justify-end gap-x-3 mt-5">
                <x-ui.buttons.danger type="button" wire:click="$parent.cancel" :title="__('Cancel')" />
                <x-ui.buttons.success type="submit" :title="__('Update')" />
            </div>
        </form>
    </x-ui.modal.body>
</x-ui.modal.box>
