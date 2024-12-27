<ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
    @foreach (['Personal Info', 'Order Info', 'Confirmation'] as $index => $label)
        <li class="flex md:w-full items-center {{ $step == $index + 1 ? 'text-[#A18A68] dark:text-[#d39b48] text-bold' : '' }} 
            sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 
            after:hidden sm:after:inline-block after:mx-6 dark:after:border-gray-700">
            <span class="flex items-center {{ $index + 1 < $step ? 'after:content-[\'/\']' : '' }} sm:after:hidden 
                after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                @if ($index + 1 < $step)
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                @else
                    <span class="me-2">{{ $index + 1 }}</span>
                @endif
                {{ $label }}
            </span>
        </li>
    @endforeach
</ol>
