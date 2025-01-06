<div class="container mx-auto px-4 py-8">
    @if ($orders->isEmpty())
    <div class="bg-gray-50 p-6 rounded-lg shadow text-center">
        <p class="text-lg text-gray-600">You have no orders yet.</p>
    </div>
    @else
    <div class="overflow-hidden border rounded-lg shadow-lg">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 uppercase text-sm">
                    <th class="py-3 px-6 text-left">Order ID</th>
                    <th class="py-3 px-6 text-left">Date</th>
                    <th class="py-3 px-6 text-left">Total</th>
                    <th class="py-3 px-6 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($orders as $order)
                <tr 
                    class="hover:bg-gray-50 transition-colors cursor-pointer" 
                    onclick="window.location.href='{{ route('order.details', ['orderId' => $order->id]) }}'">
                        <td class="py-4 px-6 font-medium text-gray-800">{{ $order->code }}</td>
                        <td class="py-4 px-1 text-gray-600">{{ $order->created_at->format('d M, Y') }}</td>
                        <td class="py-4 px-6 text-gray-800">${{ number_format($order->total_price, 2) }}</td>
                        <td class="py-4 px-2">
                            <span class="inline-block px-3 py-1 text-sm font-semibold border
                            {{ $order->status === 'packaging' ? 'border-yellow-700 text-yellow-700' : '' }}
                            {{ $order->status === 'shipping' ? 'border-blue-700 text-blue-700' : '' }}
                            {{ $order->status === 'shipped' ? 'border-green-700 text-green-700' : '' }}">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>