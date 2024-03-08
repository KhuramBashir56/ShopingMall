@props(['for'])
<select name="{{ $for }}" id="{{ $for }}" class="block w-full mt-1 text-md rounded-md focus:border-orange-500 focus:ring-orange-500 form-input" {!! $attributes !!}>
    <x-ui.form.select-option :title="__('-- Please Select Option --')" value="" selected />
    {{ $slot }}
</select>
