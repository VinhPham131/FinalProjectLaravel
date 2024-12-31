<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;
use App\Models\CartsItem;

class MergeCartOnLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        // Retrieve the guest cart from session
        $guestCart = Session::get('cart', []);

        if (!empty($guestCart)) {
            foreach ($guestCart as $productId => $details) {
                // Check if the user already has the product in their cart
                $userCart = CartsItem::firstOrNew([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                ]);

                // Update quantity
                $userCart->quantity += $details['quantity'];
                $userCart->save();
            }

            // Clear guest cart from session
            Session::forget('cart');
        }
    }
}
