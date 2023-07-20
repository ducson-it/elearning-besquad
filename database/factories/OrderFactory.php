<?php
use App\Models\Order;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_date' => $this->faker->date(),
            'user_id' => User::inRandomOrder()->first()->id,
            'course_id' => Course::inRandomOrder()->first()->id,
            'name' => $this->faker->unique()->regexify('BQ[0-9]{5}'),
        ];
    }
}
