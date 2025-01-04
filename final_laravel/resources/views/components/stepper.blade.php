<ol class="flex items-center w-[700px] text-md font-medium text-center text-gray-500 dark:text-gray-400">
    @foreach (['Personal Info', 'Confirmation', 'Order Successful'] as $index => $label)
        <li class="flex flex-1 items-center {{ $step == $index + 1 ? 'text-[#A18A68] dark:text-[#d39b48] font-bold' : '' }}">
            <div class="flex items-center">
                @if ($index + 1 < $step)
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-[#A18A68] dark:text-[#d39b48]" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                @else
                    <span class="mr-2">{{ $index + 1 }}</span>
                @endif
                {{ $label }}
            </div>
            @if ($index < count(['Personal Info', 'Order Info', 'Confirmation']) - 1)
                <div class="flex-1 h-1 mx-4 bg-gray-200 dark:bg-gray-700 {{ $index + 1 < $step ? 'bg-[#A18A68] dark:bg-[#d39b48]' : '' }}"></div>
            @endif
        </li>
    @endforeach
</ol>
