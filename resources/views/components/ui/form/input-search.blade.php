<label class="grid text-md w-full sm:max-w-md lg:max-w-xl sm:grid-cols-2 gap-4" for="search">
    {{ $slot }}
    <div class="relative w-full text-gray-500 focus-within:text-orange-500 sm:col-start-2">
        <input name="search" type="search" id="search" class="block rounded-md w-full pr-10 text-md text-black focus:ring-orange-500 focus:border-orange-500 form-input" {!! $attributes !!} />
        <div class="absolute inset-y-0 right-0 flex items-center mr-3">
            <span class="material-symbols-outlined">
                search
            </span>
        </div>
    </div>
</label>
