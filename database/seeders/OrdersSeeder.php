<?php

namespace Database\Seeders;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = [
            ['month' => 8, 'year' => 2022],
            ['month' => 9, 'year' => 2022],
            ['month' => 10, 'year' => 2022],
            ['month' => 11, 'year' => 2022],
            ['month' => 12, 'year' => 2022],
            ['month' => 1, 'year' => 2023],
            ['month' => 2, 'year' => 2023],
            ['month' => 3, 'year' => 2023],
            ['month' => 4, 'year' => 2023],
            ['month' => 5, 'year' => 2023],
            ['month' => 6, 'year' => 2023],
            ['month' => 7, 'year' => 2023],
            ['month' => 8, 'year' => 2023]
        ];

        foreach ($time as $item) {
            $month = $item['month'];
            $year = $item['year'];

            $orderCount = $month >= 7 && $month <= 11 ? rand(50, 100) : rand(1, 50);

            for ($i = 0; $i < $orderCount; $i++) {
                Order::create([
                    'order_code' => 'ORDER_' . Str::random(8),
                    'course_id' => rand(1, 9),
                    'user_id' => rand(2, 79),
                    'status' => rand(1,2),
                    'amount' => rand(100000, 500000),
                    'created_at' => Carbon::create($year, $month, rand(1, 28)),
                    'updated_at' => Carbon::create($year, $month, rand(1, 28)),
                ]);
            }
        }
    }
}
