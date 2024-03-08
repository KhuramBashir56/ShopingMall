<x-slot name="title">
    {{ __('Create New Category') }}
</x-slot>
<section class="grid gap-4">
    <x-ui.table.header>
        <x-ui.links.primary href="{{ route('admin.categories.list') }}" title="View Categories List" />
    </x-ui.table.header>
    <x-ui.form.card>
        <div class="grid md:grid-cols-2 gap-x-6 w-full">
            <x-ui.form.label :title="__('Category Title')" :for="__('title')">
                <x-ui.form.input wire:model="title" type="text" :for="__('title')" placeholder="Category title goes here..." maxlength="48" />
                @error('title')
                    <x-ui.form.input-error :message="$message" />
                @enderror
            </x-ui.form.label>

            <x-ui.form.label :title="__('Category Thumbnail')" :for="__('thumbnail')">
                <x-ui.form.input-file wire:model="thumbnail" :for="__('thumbnail')" accept=".jpg, .jpeg, .png, .svg, webp" />
                @error('thumbnail')
                    <x-ui.form.input-error :message="$message" />
                @enderror
                <x-ui.form.input-description :message="__('You can enter a maximum 5 keywords, each keyword being 48 characters long.')" />
            </x-ui.form.label>

            <div class="md:col-span-2">
                <x-ui.form.label :title="__('Category Description')" :for="__('description')">
                    <x-ui.form.textarea wire:model='description' :for="__('description')" placeholder="Category description goes here..." maxlength="500" />
                    @error('description')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                </x-ui.form.label>

                <x-ui.form.label :title="__('Meta Keywords')" :for="__('keyword')">
                    @if (count($keywords) < 5)
                        <x-ui.form.input type="text" :for="__('keyword')" wire:model="keyword" wire:keydown.enter="addKeyword" x-on:inputNull="{ $wire.keyword.value = '' }" placeholder="Write keyword and press enter key." maxlength="48" />
                    @endif
                    @error('meta_keywords')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                    <x-ui.form.input-description :message="__('The thumbnail must have dimensions between 440x248 and 1280x720 with a 16:9 aspect ratio.')" />
                </x-ui.form.label>

                <div class="flex flex-wrap -mt-2 mb-3 gap-x-1 gap-y-3">
                    @foreach ($keywords as $index => $data)
                        <span class="flex items-center justify-center px-2 py-1 text-sm font-medium bg-orange-500 text-white rounded w-fit me-2">
                            {{ $data }}
                            <button wire:click="removeKeyword({{ $index }})" type="button" class="flex items-center justify-center text-sm text-white bg-transparent rounded-sm ms-2 hover:bg-orange-200 hover:text-orange-500">
                                <span class="material-symbols-outlined">{{ __('close') }}</span>
                            </button>
                        </span>
                    @endforeach
                </div>

                <x-ui.form.label :title="__('Meta Description')" :for="__('meta_description')">
                    <x-ui.form.textarea wire:model='meta_description' :for="__('meta_description')" placeholder="Category meta description wite here maximum 160 characters." maxlength="160" />
                    @error('meta_description')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                </x-ui.form.label>

                <div class="flex items-center justify-end gap-x-3">
                    <x-ui.buttons.danger wire:click="cancel" type="button" title="Cancel" />
                    <x-ui.buttons.success wire:click="store" type="button" :title="__('Save')" />
                </div>
            </div>
        </div>
    </x-ui.form.card>
</section>
