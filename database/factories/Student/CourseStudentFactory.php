<?php

namespace Database\Factories\Student;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Student\CourseStudent;

class CourseStudentFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = CourseStudent::class;

    public function definition(): array
    {
        return [
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
            'status' => $this->faker->randomElement(['in_edu', 'graduated', 'excluded']),
            'course_id' => rand( 1, 9 ),
            'student_id' => rand( 1, 9 ),
        ];
    }
}
