@extends('layouts.app')

@section('title', 'Order Summary')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 space-y-10">

        <!-- Page Title -->
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-800">Order Summary</h1>
            <p class="text-gray-600 mt-3">Thank you for your order! Here’s a detailed summary of your purchase.</p>
        </div>

        <!-- Order Overview Section -->
        <div class="grid grid-cols-2 gap-8">
            <!-- Order Details Card -->
            <div class="bg-white rounded-lg shadow-xl p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Order Details</h2>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Order ID:</span>
                        <span class="text-gray-900 font-bold">{{ $order->code }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Order Date:</span>
                        <span class="text-gray-900">{{ $order->created_at->format('F j, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Total Amount:</span>
                        <span
                            class="text-a28b68 font-bold text-lg">${{ number_format($order->total_price, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Payment Method:</span>
                        <span class="text-gray-900">{{ $order->payment }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 font-medium">Order Status:</span>
                        <span class="text-gray-900">{{ $order->status }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping Information Card -->
            <div class="bg-white rounded-lg shadow-xl p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Shipping Information</h2>
                <div class="grid grid-cols-2 gap-6">
                    <p class="text-gray-700"><span class="font-medium">Name:</span> {{ $order->last_name }}
                        {{ $order->first_name }}
                    </p>
                    <p class="text-gray-700"><span class="font-medium">Email:</span> {{ $order->email }}</p>
                    <p class="text-gray-700"><span class="font-medium">Phone:</span> {{ $order->phone }}</p>
                    <p class="text-gray-700"><span class="font-medium">Address:</span> {{ $order->address }}</p>
                </div>
                <div class="mt-6 flex">
                    <span>Note:</span>
                    <p class="text-gray-700 ml-2">{{ $order->note }}</p>
                </div>
            </div>
        </div>

        <!-- Items Section -->
        <div class="bg-white rounded-lg shadow-xl p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Items in Your Order</h2>
            <div class="grid grid-cols-2 gap-6">
                @foreach ($order->items as $item)
                    <!-- Item Card -->
                    <div class="bg-gray-50 rounded-lg shadow-md p-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 text-center">{{ $item->product->name }}</h3>
                            <div class="grid grid-cols-2 mt-5 gap-[50px]">
                                <div>
                                    <img src="{{ $item->product->getPrimaryImagePath() }}" alt="{{ $item->product->name }}"
                                        class="w-[150px] h-[150px] object-cover rounded-lg">
                                </div>
                                <div>
                                    <div class="flex items-center mt-1">
                                        <span class="text-gray-600">Collection:</span>
                                        <span
                                            class="text-gray-800 font-medium ml-2">{{ $item->product->collection->name }}</span>
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <span class="text-gray-600">Material:</span>
                                        <span class="text-gray-800 font-medium ml-2">{{ $item->product->material }}</span>
                                    </div>
                                    <div class="flex items-center mt-2">
                                        <span class="text-gray-600">Size:</span>
                                        <span class="text-gray-800 font-medium ml-2">{{ $item->product->size }}</span>
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <span class="text-gray-600">Color:</span>
                                        <span class="text-gray-800 font-medium ml-2">{{ $item->product->color }}</span>
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <span class="text-gray-600">Quantity:</span>
                                        <span class="text-gray-800 font-medium ml-2">{{ $item->quantity }}</span>
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <span class="text-gray-600">Price:</span>
                                        <span
                                            class="text-a28b68 font-bold ml-2">${{ number_format($item->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 space-y-2">
                            <div class="flex justify-end text-gray-800 font-bold">
                                <span class=" text-a28b68 text-[20px]">Total:</span>
                                <span class=" text-a28b68 text-[20px] ml-2">${{ number_format($item->price * $item->quantity, 2) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection