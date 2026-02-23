@props(['status'])

@if ($status)
    <div {{ $attributes->merge([
        'class' => 'mb-5 flex items-center gap-3 p-4 rounded-xl bg-green-50 border border-green-200 shadow-sm'
    ]) }}>

        <!-- Icon -->
        <div class="flex-shrink-0">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12l2 2l4 -4M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10z" />
            </svg>
        </div>

        <!-- Text -->
        <div class="text-sm font-medium text-green-800">
            {{ $status }}
        </div>
    </div>
@endif
