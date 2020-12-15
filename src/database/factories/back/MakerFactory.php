<?php

namespace Database\Factories\Back;

use App\Models\Back\Maker;
use Illuminate\Database\Eloquent\Factories\Factory;

class MakerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Maker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => '08012341234',
            'address' => $this->faker->address,
        ];
    }
}
