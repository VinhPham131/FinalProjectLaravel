<!-- Search Bar -->
<form id="search-form" method="GET" action="/shop" class="max-w-[1200px] w-[220px]">
        <label for="default-search" class="text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative phone:max-tablet:start-[40%]">
          <input type="text" placeholder="Search" name="search" value="{{ request('search') }}" id="default-search"
            class="block w-full p-4 ps-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
            required />
          <button type="submit"
            class="absolute end-2.5 bottom-2.5 bg-white focus:ring-2 focus:outline-none rounded-lg py-2">
            <img
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/e049bbac9007f28b8521ba6a8adffac68548815191ee5882c549324c1ea8d37d?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
              alt="Search icon">
          </button>
        </div>
      </form>
      <div id="searchResults" class="search-results mt-4">
      </div>

      <!-- Filter -->
      <section class="select-none phone:max-tablet:grid phone:max-tablet:justify-center">
  <div class="phone:max-tablet:flex gap-3 relative" id="dropdownArea">
    <!-- Shop By -->
<div id="checkBoxCategory" class="relative">
  <div
    id="categoryToggle"
    class="border border-gray-300 mb-5 px-5 py-2 rounded cursor-pointer text-sm flex justify-between w-[220px] phone:max-tablet:w-full phone:max-tablet:max-w-[180px]"
  >
    Select Category
    <img
      width="10"
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/e94ec9341bd16f6adc455126d5a4c0f9b93274f8dd2680479859e3afea8c2f6a?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
      alt="Dropdown Icon"
    />
  </div>
  <div
    id="dropdownCategory"
    class="hidden rounded border border-gray-300 bg-white absolute top-[50px] phone:max-tablet:top-[80px] w-[220px] phone:max-tablet:w-full phone:max-tablet:max-w-[180px] shadow-md z-20"
  >
    <label class="cursor-pointer hover:bg-gray-200 p-4 text-sm flex items-center">
      <input type="checkbox" class="mr-2 category-checkbox" value="Bronze" />
      Bronze
    </label>
    <label class="cursor-pointer hover:bg-gray-200 p-4 text-sm flex items-center">
      <input type="checkbox" class="mr-2 category-checkbox" value="Silver" />
      Silver
    </label>
    <label class="cursor-pointer hover:bg-gray-200 p-4 text-sm flex items-center">
      <input type="checkbox" class="mr-2 category-checkbox" value="Gold" />
      Gold
    </label>
    <label class="cursor-pointer hover:bg-gray-200 p-4 text-sm flex items-center">
      <input type="checkbox" class="mr-2 category-checkbox" value="Diamond" />
      Diamond
    </label>
  </div>
</div>

<!-- Sort By Dropdown -->
<div id="sortBy" class="relative">
  <div
    class="border border-gray-300 px-5 py-2 rounded cursor-pointer text-sm flex justify-between w-[220px] phone:max-tablet:w-full phone:max-tablet:max-w-[180px]"
  >
    Sort By
    <img
      width="10"
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/e94ec9341bd16f6adc455126d5a4c0f9b93274f8dd2680479859e3afea8c2f6a?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
      alt="Dropdown Icon"
    />
  </div>
  <div
    id="dropdownSort"
    class="hidden rounded border border-gray-300 bg-white absolute top-[50px] phone:max-tablet:top-[80px] w-[220px] phone:max-tablet:w-full phone:max-tablet:max-w-[180px] shadow-md z-20"
  >
    <div class="cursor-pointer hover:bg-gray-200 p-4 text-sm">Lowest</div>
    <div class="cursor-pointer hover:bg-gray-200 p-4 text-sm">Highest</div>
    <div class="cursor-pointer hover:bg-gray-200 p-4 text-sm">Best Seller</div>
    <div class="cursor-pointer hover:bg-gray-200 p-4 text-sm">New Arrival</div>
  </div>
</div>
  </div>
</section>

      <!-- On Sale and In stock-->
      <section class="phone:max-tablet:flex phone:max-tablet:justify-center phone:max-tablet:gap-10">
        <div
          class="flex justify-between phone:max-tablet:my-4 my-10 phone:max-tablet:w-[full] phone:max-tablet:max-w-[150px] w-[220px] z-0">
          <a>On sale</a>
          <label class="inline-flex items-center cursor-pointer">
            <input type="checkbox" value="" class="sr-only peer">
            <div
              class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
            </div>
          </label>
        </div>
        <div
          class="flex justify-between phone:max-tablet:w-[full] phone:max-tablet:max-w-[150px] w-[220px] z-0 items-center">
          <a>In stock</a>
          <label class="inline-flex items-center cursor-pointer">
            <input type="checkbox" value="" class="sr-only peer">
            <div
              class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
            </div>
          </label>
        </div>
      </section>