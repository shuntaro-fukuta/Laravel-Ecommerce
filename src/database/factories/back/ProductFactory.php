<?php

namespace Database\Factories\Back;

use App\Models\Back\Product;
use App\Models\Back\Category;
use App\Models\Back\Maker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jan_code' => $this->faker->unique()->bothify('#############'),
            'category_id' => Category::factory(1)->create()->first()->id,
            'maker_id' => Maker::factory(1)->create()->first()->id,
            'name' => $this->faker->lexify('Item???#'),
            'price' => $this->faker->numberBetween(100, 100000),
            'description' => $this->faker->realText(20),
            'is_published' => ($this->faker->numberBetween(0, 2)) ? true : false,
        ];
    }
}
