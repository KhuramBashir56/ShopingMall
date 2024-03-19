@props(['width'])
<div class="fixed inset-0 z-50 p-8 flex w-screen h-screen overflow-y-auto bg-black bg-opacity-75 sm:justify-center">
    <div class="bg-white h-fit my-auto rounded-lg {{ $width }} w-full">
        {{ $slot }}
    </div>
</div>
