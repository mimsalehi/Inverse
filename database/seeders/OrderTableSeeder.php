<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{

    const LIMIT_ORDERS = 100;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($orders = 0; $orders < self::LIMIT_ORDERS; $orders++) {

            /** @var User $user */
            $user = User::query()->inRandomOrder()->first();

            // Getting from 2 upto 10 random courses
            $courses = Course::query()->inRandomOrder()->take(rand(2, 10))->get();

            // Sum their prices
            $sum_prices = $courses->sum('price');

            // pluck their IDs
            $course_ids = $courses->pluck('id')->toArray();

            $has_discount = rand(1, 10) > 0;

            // Creating an order

            /** @var Order $order */
            $order = Order::factory()
                ->create([
                    'user_id' => $user->getAuthIdentifier(),
                    'description' => sprintf('Order for Courses %s', implode($course_ids)),
                    'total_price' => $sum_prices,
                    'has_discount' => $has_discount,
                    'discount' => $has_discount ? rand(10, 80) : 0,
                    'created_at' => now()->endOfYear()->subMonth(rand(1, 11)),
                ]);

            // Syncing order with courses
            $order->courses()->sync($course_ids);
        }
    }
}
