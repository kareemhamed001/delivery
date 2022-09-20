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
            'price'=>fake()->numberBetween(10,200),
            'accepted_by'=>User::where('role_as','1')->inRandomOrder()->limit(1)->first()->id,
            'finished_by'=>User::where('role_as','1')->inRandomOrder()->limit(1)->first()->id,
            'accepted'=>fake()->numberBetween(0,1),
            'finished'=>fake()->numberBetween(0,1),

            'delivery_time'=>fake()->dateTimeBetween('-8 months','+3 months') ,
            'created_at'=>now(),
            'updated_at'=>now(),

        ];
    }
}
