<?php

namespace Database\Seeders;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function generateRandomDateTime($specificDate)
    {
        $startTime = '00:00:00';      // Replace with the desired start time
        $endTime = '23:00:00';        // Replace with the desired end time

        $startTimestamp = strtotime("$specificDate $startTime");
        $endTimestamp = strtotime("$specificDate $endTime");

        $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
        $randomDateTime = Carbon::createFromTimestamp($randomTimestamp);

        return $randomDateTime;
    }
    public function run()
    {
        $year2023 = 2023; // Replace with the desired year
        $year2022 = 2022;
        $month1 = Carbon::createFromDate($year2023, 1)->daysInMonth;
        for ($day = 1; $day <= $month1; $day++) {
            $date = Carbon::create($year2023, 1, $day);
            Order::create([
                    'order_code' => 'BQ'.rand(100000,999999),
                    'course_id' => 1,
                    'user_id' => 2,
                    'amount' => rand(100000,999999),
                    'created_at' => generateRandomDateTime($date)
                ]);
        }
//        $month2 = Carbon::createFromDate($year2023, 2)->daysInMonth;
//        $month3 = Carbon::createFromDate($year2023, 3)->daysInMonth;
//        $month4 = Carbon::createFromDate($year2023, 4)->daysInMonth;
//        $month5 = Carbon::createFromDate($year2023, 5)->daysInMonth;
//        $month6 = Carbon::createFromDate($year2023, 6)->daysInMonth;
//        $month7 = Carbon::createFromDate($year2023, 7)->daysInMonth;
//        $month8 = Carbon::createFromDate($year2023, 8)->daysInMonth;
//        $month82022 = Carbon::createFromDate($year2022, 8)->daysInMonth;
//        $month92022 = Carbon::createFromDate($year2022, 9)->daysInMonth;
//        $month102022 = Carbon::createFromDate($year2022, 10)->daysInMonth;
//        $month112022 = Carbon::createFromDate($year2022, 11)->daysInMonth;
//        $month122022 = Carbon::createFromDate($year2022, 12)->daysInMonth;
    }


}
