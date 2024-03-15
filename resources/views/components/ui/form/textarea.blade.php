@props(['for'])
<textarea name="{{ $for }}" id="{{ $for }}" class="block w-full mt-1 rounded-md text-sm form-textarea focus:border-orange-500 focus:ring-orange-500" rows="5" {!! $attributes->merge([]) !!}></textarea>
<span class="text-xs text-gray-500 inline-block mr-0 float-right -mt-5 mr-2" x-show="$wire.{{ $for }}?.length" x-text="{{ $for }}.getAttribute('maxlength') - $wire.{{ $for }}?.length"></span>
