<x-slot name="title">
    {{ __('Add New Stock') }}
</x-slot>
<section class="grid gap-4">
    <x-ui.alert-messages />
    <x-panel.ui.page-header>
        <x-ui.links.primary href="{{ route('admin.stock-management.history') }}" title="Stock History" />
    </x-panel.ui.page-header>
    <x-panel.ui.card>
        <div class="grid md:grid-cols-3 gap-x-6 w-full">
            <x-ui.form.label :title="__('Stock Suppler Name')" :for="__('supplier_name')">
                <x-ui.form.input type="text" wire:model='supplier_name' :for="__('supplier_name')" placeholder="Stock Supplied by name goes here..." maxlength="48" />
                @error('supplier_name')
                    <x-ui.form.input-error :message="$message" />
                @enderror
            </x-ui.form.label>

            <x-ui.form.label :title="__('Stock Supply Bill / Invoice #')" :for="__('invoice')">
                <x-ui.form.input type="number" wire:model='invoice' :for="__('invoice')" placeholder="Stock Supply Bill / Invoice goes here..." maxlength="15" />
                @error('invoice')
                    <x-ui.form.input-error :message="$message" />
                @enderror
            </x-ui.form.label>

            <x-ui.form.label :title="__('Stock Delivery Date')" :for="__('delivery')">
                <x-ui.form.input type="date" wire:model='delivery' :for="__('delivery')" placeholder="Stock Delivery Date goes here..." max="{{ date('Y-m-d') }}" />
                @error('delivery')
                    <x-ui.form.input-error :message="$message" />
                @enderror
            </x-ui.form.label>

            @if (count($items) >= 1)
                <div class="md:col-span-3 my-3">
                    <x-ui.table.table>
                        <x-ui.table.thead>
                            <x-ui.table.th :content="__('sr#')" />
                            <x-ui.table.th :content="__('Item Name / Title')" />
                            <x-ui.table.th :content="__('Stock Unit')" />
                            <x-ui.table.th :content="__('Expiry Date')" />
                            <x-ui.table.th :content="__('Quantity')" />
                            <x-ui.table.th :content="__('Purchase Price')" />
                            <x-ui.table.th :content="__('Purchase Total')" />
                            <x-ui.table.th :content="__('action')" />
                        </x-ui.table.thead>
                        <x-ui.table.tbody>
                            @foreach ($items as $index => $data)
                                <x-ui.table.tr>
                                    <x-ui.table.td :content="$index + 1" />
                                    <x-ui.table.td :content="$data[1]" />
                                    <x-ui.table.td :content="$data[3]" />
                                    <x-ui.table.td :content="Carbon\Carbon::parse($data[4])->format('d-m-Y')" />
                                    <x-ui.table.td :content="$data[5]" />
                                    <x-ui.table.td :content="$data[6]" />
                                    <x-ui.table.td :content="$data[7]" />
                                    <x-ui.table.td>
                                        <x-ui.table.actions>
                                            <x-ui.table.action-button wire:click='remove_item({{ $index }})' :title="__('Delete')" :icon="__('delete')" />
                                        </x-ui.table.actions>
                                    </x-ui.table.td>
                                </x-ui.table.tr>
                            @endforeach
                            <x-ui.table.tr>
                                <x-ui.table.td :content="__('Grand Total')" colspan="6" />
                                <x-ui.table.td :content="$total" colspan="2" />
                            </x-ui.table.tr>
                        </x-ui.table.tbody>
                    </x-ui.table.table>
                    </strong>
                </div>
            @endif
            <div class="md:col-span-3 grid gap-x-6 gap-y-0 md:grid-cols-5">
                <div class="md:col-span-2 relative">
                    <x-ui.form.label :title="__('Item Name')" :for="__('item_name')">
                        <x-ui.form.input type="text" wire:model.live='item_name' wire:click="search_item" :for="__('item_name')" placeholder="Item name goes here..." maxlength="48" />
                        @error('item_name')
                            <x-ui.form.input-error :message="$message" />
                        @enderror
                    </x-ui.form.label>
                    @if ($products_list)
                        <ul class="absolute top-[72px] left-0 shadow-md bg-white w-full max-h-64 overflow-y-auto border border-gray-500">
                            @forelse ($products as $index => $data)
                                <li><span wire:click="select_item({{ $data->id }})" class="text-md text-gray-500 hover:bg-blue-700 hover:text-white px-3 py-1 block cursor-pointer">{{ $data->name }}</span></li>
                            @empty
                                <li><span class="text-md text-gray-500 hover:bg-blue-700 hover:text-white px-3 py-1 block cursor-pointer">{{ __('Item Not Found...') }}</span></li>
                            @endforelse
                        </ul>
                    @endif
                </div>

                <x-ui.form.label :title="__('Unit')" :for="__('unit_id')">
                    <x-ui.form.select wire:model='unit_id' :for="__('unit_id')">
                        @forelse ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->title . ' (' . $unit->code . ')' }}</option>
                        @empty
                            <option value="" disabled>Units Not Found...</option>
                        @endforelse
                    </x-ui.form.select>
                    @error('unit_id')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                </x-ui.form.label>

                <x-ui.form.label :title="__('Quantity')" :for="__('quantity')">
                    <div class="flex mt-1">
                        <button wire:click="quantity_decrement" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-l text-sm px-3 py-1">
                            <span class="material-symbols-outlined">remove</span>
                        </button>
                        <input wire:model="quantity" type="number" id="quantity" name="quantity" placeholder="Quantity goes here..." max="999" class="block w-full text-md text-center focus:border-orange-500 focus:ring-orange-500 form-input" />
                        <button wire:click="quantity_increment" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-r text-sm px-3 py-1">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                    </div>
                    @error('quantity')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                </x-ui.form.label>

                <x-ui.form.label :title="__('Purchase Price')" :for="__('purchase_price')">
                    <x-ui.form.input type="number" wire:model='purchase_price' :for="__('purchase_price')" placeholder="Purchase Price goes here..." min="1" max="9999999" />
                    @error('purchase_price')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                </x-ui.form.label>

                <x-ui.form.label :title="__('Purchase Total')" :for="__('purchase_total')">
                    <x-ui.form.input type="number" readonly wire:model='purchase_total' x-model='$wire.quantity * $wire.purchase_price' :for="__('purchase_total')" placeholder="Purchase Total goes here..." min="1" />
                    @error('purchase_total')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                </x-ui.form.label>

                <x-ui.form.label :title="__('Retail Price')" :for="__('price')">
                    <x-ui.form.input type="number" wire:model='price' :for="__('price')" placeholder="Price goes here..." min="1" max="9999999" />
                    @error('price')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                </x-ui.form.label>

                <x-ui.form.label :title="__('Whole Sale Price')" :for="__('whole_sale')">
                    <x-ui.form.input type="number" wire:model='whole_sale' :for="__('whole_sale')" placeholder="Whole Sale price goes here..." min="1" max="9999999" />
                    @error('whole_sale')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                </x-ui.form.label>

                <x-ui.form.label :title="__('Expiry Date')" :for="__('expiry_date')">
                    <x-ui.form.input type="date" wire:model='expiry_date' :for="__('expiry_date')" placeholder="Expiry Date goes here..." min="{{ date('Y-m-d') }}" />
                    @error('expiry_date')
                        <x-ui.form.input-error :message="$message" />
                    @enderror
                </x-ui.form.label>

                <div class="col-span-1 flex justify-center items-center md:mt-3">
                    <x-ui.buttons.primary wire:click='add_item' :title="__('Add Item')" :icon="__('add')" />
                </div>
            </div>
        </div>
        <x-ui.form.label :title="__('Remarks')" :for="__('remarks')">
            <x-ui.form.textarea wire:model='remarks' :for="__('remarks')" placeholder="Remarks goes here..." maxlength="255" />
            @error('remarks')
                <x-ui.form.input-error :message="$message" />
            @enderror
        </x-ui.form.label>
        <div class="flex items-center justify-end gap-x-3">
            <x-ui.buttons.danger wire:click="cancel" type="button" wire:confirm="Are you sure, you want to destroy form data ?" title="Cancel" />
            <x-ui.buttons.success wire:click="store" type="button" :title="__('Save')" />
        </div>
    </x-panel.ui.card>
</section>
