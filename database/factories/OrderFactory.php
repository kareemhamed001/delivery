<?php

namespace Database\Factories;

use App\Models\Order;
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
            'user_id'=>1,
            'name'=>fake()->name(),
            'description'=>fake()->realText(100),
            'from_address'=>fake()->address(),
            'to_address'=>fake()->address(),
            'notes'=>fake()->realText(),
            'delivery_time'=>fake()->dateTimeBetween('11/6/2020','11/6/2030') ,
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }
}
