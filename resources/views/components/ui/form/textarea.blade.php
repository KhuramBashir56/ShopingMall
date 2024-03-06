@props(['for', 'value'])
<textarea name="{{ $for }}" id="{{ $for }}" class="block w-full mt-1 rounded-md text-sm form-textarea focus:border-orange-500 focus:ring-orange-500" rows="5" {!! $attributes->merge([]) !!}>{{ !empty($value) ? $value : '' }}</textarea>
