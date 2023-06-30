<?php

namespace Database\Factories\Student;

use App\Models\Student\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' =>  $this->faker->unique()->words(3, true),
            'description' => $this->faker->realText(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
