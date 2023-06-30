<?php

namespace Database\Factories\Student;

use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'comment' => $this->faker->realText(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
            'date_entered' => $this->faker->dateTimeBetween('-2 year', '-1 year'),
            'date_finished' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => $this->faker->randomElement(['in_edu', 'graduated', 'excluded']),
        ];
    }
}
