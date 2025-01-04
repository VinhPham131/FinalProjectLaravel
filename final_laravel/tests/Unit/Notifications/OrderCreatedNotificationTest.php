<?php

namespace Tests\Unit\Notifications;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Notifications\OrderCreatedNotification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class OrderCreatedNotificationTest extends TestCase
{
    use RefreshDatabase;
    public function test_it_should_send_order_created_notification()
    {
         // Fake notifications
         Notification::fake();

         // Create a sample user
         $user = User::factory()->create([
             'id' => 1,
             'name' => 'John Doe',
             'email' => 'john@example.com',
         ]);
 
         // Create a sample order associated with the user
         $order = Order::factory()->create([
             'user_id' => $user->id,
             'first_name' => 'John',
             'last_name' => 'Doe',
             'email' => 'john@example.com',
             'country' => 'Testland',
             'address' => '123 Test Street',
             'phone' => '+84111122222',
             'note' => 'Please deliver ASAP',
             'payment' => 'paypal',
             'total_price' => 150.00,
         ]);
 
         // Attach order items to the order
         $products = Product::factory()->count(3)->create();
         foreach ($products as $product) {
             OrderItem::factory()->create([
                 'order_id' => $order->id,
                 'product_id' => $product->id,
                 'quantity' => 2,
                 'price' => $product->price,
             ]);
         }
 
         // Trigger the notification
         $user->notify(new OrderCreatedNotification($order));
 
         // Assert the notification was sent
         Notification::assertSentTo(
            [$user],
            OrderCreatedNotification::class,
            function (OrderCreatedNotification $notification, array $channels) use ($order) {
                return $notification->getOrder()->id === $order->id;
            }
        );
    }
}
