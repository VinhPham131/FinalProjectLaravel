<!-- User Avatar Button -->
@auth
  <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="flex text-sm md:me-0" type="button">
    <span class="sr-only">Open user menu</span>
    <img loading="lazy"
    src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f730e5942965a07e5a2ab20fe941c2b09c71126a0ad6a759c38c6b0eaefa36d?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
    alt="Image description"
    class="shrink-0 self-start w-5 border border-white border-solid aspect-[0.95] fill-black stroke-[1px] stroke-white" />
  </button>

  <!-- Dropdown menu -->
  <div id="dropdownAvatar" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
    <div class="px-4 py-3 text-[15px] text-gray-900 dark:text-white">
    <div>{{ Auth::user()->name }}</div>
    <div class="font-medium truncate">{{ Auth::user()->email }}</div>
    </div>
    <ul class="py-2 text-[15px] text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserAvatarButton">
    <li>
      <a href="{{ route('user.profile') }}"
      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
    </li>
    <li>
      <a href="{{ route('user.order') }}"
      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Order</a>
    </li>
    <li>
      <a href="{{ route('user.account') }}"
      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Account</a>
    </li>
    </ul>
    <div class="py-2">
    <a href="{{ route('logout') }}"
      class="block px-4 py-2 text-[15px] text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      Sign out
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
      @csrf
    </form>
    </div>
  </div>
@endauth

@guest
  <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="flex text-sm md:me-0" type="button">
    <span class="sr-only">Open user menu</span>
    <img loading="lazy"
    src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f730e5942965a07e5a2ab20fe941c2b09c71126a0ad6a759c38c6b0eaefa36d?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
    alt="Image description"
    class="shrink-0 self-start w-5 border border-white border-solid aspect-[0.95] fill-black stroke-[1px] stroke-white" />
  </button>
  <div id="dropdownAvatar" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-32">
    <ul class="py-2 text-[15px] text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserAvatarButton">
    <li>
      {{-- <a href="{{route('login')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Login</a> --}}
      <button onclick="Livewire.dispatch('openModal', { component: 'login-modal' })">Login</button>
    </li>
    <li>
      <a href="{{route('register')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Register</a>
    </li>
    </ul>
  </div>


@endguest