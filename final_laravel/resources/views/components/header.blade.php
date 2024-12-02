<!-- Navigation Bar -->
<section class="grid tablet:justify-center">
    <header
        class="flex flex-row justify-between border-b-2 bg-white my-5 mb-10 phone:max-tablet:mb-10 phone:max-tablet:border-b-0 tablet:mx-[200px] tablet:max-w-[1200px] phone:mx-[10px] tablet:w-[calc(1200px-350px)] laptop:w-[calc(1200px-100px)] shadow-sm">
        <div class="flex flex-row mt-1 ml-2 tablet:hidden">
            <a href="#">
                <img loading="lazy"
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f730e5942965a07e5a2ab20fe941c2b09c71126a0ad6a759c38c6b0eaefa36d?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
                    alt="Image description" class="size-7" />
            </a>
        </div>
        <a href="/">
            <div class="text-4xl leading-10 text-stone-950 phone:max-tablet:ml-0 phone:max-tablet:mb-5">
                <font color="#a28b68">L</font><span class="text-neutral-950">B</span><span
                    class="tetx-stone-950">J</span>
            </div>
        </a>
        <div class="menu-item relative tablet:hidden" style="opacity: 0; visibility: hidden;">
            <div class="menu-open-btn phone:max-tablet:mb-5 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </div>
            <nav
                class="offcanvas-menu fixed bg-gray-200 h-full top-0 right-0 w-2/3 flex px-6 duration-200 z-30 translate-x-full">
                <div class="menu-close-btn absolute top-6 left-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <ul class="flex flex-col mt-16">
                    <li class="my-5">
                        <a href="/" class="text-xl font-semibold hover:text-red-500 duration-300">Home</a>
                    </li>
                    <li class="my-5">
                        <a href="/shop" class="text-xl font-semibold hover:text-red-500 duration-300">Shop</a>
                    </li>
                    <li class="my-5">
                        <a href="/about" class="text-xl font-semibold hover:text-red-500 duration-300">About Us</a>
                    </li>
                    <li class="my-5">
                        <a href="#" class="text-xl font-semibold hover:text-red-500 duration-300">Cart</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="flex flex-row phone:max-tablet:hidden">
            <ul class="flex flex-row gap-8">
                <li class="p-4"><a href="/shop">Shop</a></li>
                <li class="p-4"><a href="/about">About Us</a></li>
            </ul>
            <div class="shrink-0 w-px border border-solid bg-neutral-500 border-neutral-500 h-[22px] my-auto mx-10">
            </div>
            <div class="flex flex-row p-4 gap-10">
                <img loading="lazy"
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/b53ad79a5e4ea34706fc375724ee506199b29340c27f09c40ae777a95cc73c28?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
                    alt="Image description"
                    class="shrink-0 self-start border border-white border-solid aspect-square fill-black stroke-[0.75px] stroke-white w-[19px]" />
                <img loading="lazy"
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/324b097b3a26f24da080c52561d900b13bf05f0d28848eed44fbb39ad816c1d1?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
                    alt="Image description" class="shrink-0 self-start aspect-square w-[21px]" />


                <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                    class="flex text-sm md:me-0 "
                    type="button">
                    <span class="sr-only">Open user menu</span>
                    <img loading="lazy"
                        src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f730e5942965a07e5a2ab20fe941c2b09c71126a0ad6a759c38c6b0eaefa36d?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
                        alt="Image description"
                        class="shrink-0 self-start w-5 border border-white border-solid aspect-[0.95] fill-black stroke-[1px] stroke-white" />
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownAvatar"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        <div>Bonnie Green</div>
                        <div class="font-medium truncate">name@flowbite.com</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownUserAvatarButton">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Order</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Account</a>
                        </li>
                    </ul>
                    <div class="py-2">
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                            out</a>
                    </div>
                </div>

            </div>
        </div>
    </header>
</section>
<!-- Navigation Bar -->