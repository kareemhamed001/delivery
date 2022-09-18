<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\orders>
 */
class OrderFactory extends Factory
{
protected $model=Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>User::inRandomOrder()->limit(1)->first()->id,
            'name'=>fake()->name(),
            'description'=>fake()->realText(100),
            'from_address'=>fake()->address(),
            'to_address'=>fake()->address(),
            'notes'=>fake()->realText(),
            'delivery_time'=>fake()->dateTimeBetween('-2 day','+2 day') ,
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
