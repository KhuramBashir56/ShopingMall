@if (session('error'))
    <div class="absolute right-6 bottom-6 z-[9999999] flex items-center w-fit max-w-lg p-4 mb-4 text-gray-500 bg-red-200 rounded-lg shadow " role="alert" x-data="{ showAlert: true }" x-show="showAlert" x-init="setTimeout(() => showAlert = false, 3000)">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
            </svg>
            <span class="sr-only">Error icon</span>
        </div>
        <div class="ms-3 text-md font-medium text-red-900">{{ session('error') }}</div>
    </div>
@endif

@if (session('success'))
    <div class="absolute right-6 bottom-6 z-[9999999] flex items-center w-fit max-w-lg p-4 mb-4 text-gray-500 bg-green-200 rounded-lg shadow " role="alert" x-data="{ showAlert: true }" x-show="showAlert" x-init="setTimeout(() => showAlert = false, 3000)">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-md font-medium text-green-900">{{ session('success') }}</div>
    </div>
@endif

@if (session('warning'))
    <div class="absolute right-6 bottom-6 z-[9999999] flex items-center w-fit max-w-lg p-4 text-gray-500 bg-orange-200 rounded-lg shadow " role="alert" x-data="{ showAlert: true }" x-show="showAlert" x-init="setTimeout(() => showAlert = false, 3000)">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
            </svg>
            <span class="sr-only">Warning icon</span>
        </div>
        <div class="ms-3 text-md font-medium text-orange-900">{{ session('warning') }}</div>
    </div>
@endif
