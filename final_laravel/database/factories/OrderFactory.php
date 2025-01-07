<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{   
    protected $model = Order::class;
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'country' => $this->faker->country,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'note' => $this->faker->sentence,
            'payment' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'total_price' => $this->faker->randomFloat(2, 10, 1000),
            'code' => 'ID-' . strtoupper(Str::random(8)),
        ];
    }
}
