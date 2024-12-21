<button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
    class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400"
    type="button">
    <img loading="lazy"
        src="https://cdn.builder.io/api/v1/image/assets/TEMP/324b097b3a26f24da080c52561d900b13bf05f0d28848eed44fbb39ad816c1d1?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
        alt="Cart" class="shrink-0 self-start aspect-square w-[21px]" />
    <!-- 
    <div
        class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 dark:border-gray-900">
    </div> -->
</button>

<!-- Dropdown menu -->
<div id="dropdownNotification"
    class="z-20 hidden w-[300px] max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
    aria-labelledby="dropdownNotificationButton">
    <!-- Cart items -->
    <div class="divide-y divide-gray-100 dark:divide-gray-700">
        <div>
            <div class="flex items-center justify-between p-4">
                <div class="flex flex-row items-center gap-4">
                    <img loading="lazy"
                        src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f730e5942965a07e5a2ab20fe941c2b09c71126a0ad6a759c38c6b0eaefa36d?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
                        alt="Image description" class="w-16 h-16" />
                    <div class="flex flex-col">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">Product name</div>
                        <div class="flex items-center gap-2">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Quantity:</div>
                            <button
                                class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">-</button>
                            <div class="text-sm text-gray-500 dark:text-gray-400">1</div>
                            <button
                                class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">+</button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-end">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">$100.00</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Size: M</div>
                </div>
            </div>
        </div>
    </div>
    <a href="#"
        class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
        <div class="inline-flex items-center ">
            <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                <path
                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
            </svg>
            View all
        </div>
    </a>
</div>