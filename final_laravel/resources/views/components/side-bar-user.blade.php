<div class="h-screen w-[300px] p-4 bg-gray-100 ml-[150px]">
    <div class="flex flex-col space-y-4">
        <a href="{{ route('user.cart') }}" class="block p-4 border-b-2 border-transparent rounded-lg hover:text-gray-600 hover:border-gray-300 {{ $activeTab === 'cart' ? 'text-blue-500 border-blue-500' : '' }}">
            My Cart
        </a>
        <a href="{{ route('user.order') }}" class="block p-4 border-b-2 border-transparent rounded-lg hover:text-gray-600 hover:border-gray-300 {{ $activeTab === 'order' ? 'text-blue-500 border-blue-500' : '' }}">
            My Orders
        </a>
        <a href="{{ route('user.account') }}" class="block p-4 border-b-2 border-transparent rounded-lg hover:text-gray-600 hover:border-gray-300 {{ $activeTab === 'account' ? 'text-blue-500 border-blue-500' : '' }}">
            Account
        </a>
    </div>
</div>
