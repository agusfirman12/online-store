@props(['height' => ''])
<div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity flex  items-center justify-center p-5 sm:p-0">
    <div
        class="max-w-7xl {{ $height }} mx-auto my-3 w-full md:w-3/4 lg:w-1/3 px-6 lg:px-8 py-6 bg-gray-700 rounded-lg overflow-auto z-50">
        {{ $slot }}
    </div>
</div>
