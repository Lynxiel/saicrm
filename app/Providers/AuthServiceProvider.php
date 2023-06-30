<?php

namespace App\Providers;

use App\Models\Student\Category;
use App\Models\Student\Course;
use App\Models\Student\CourseStudent;
use App\Models\Student\Student;
use App\Policies\Student\CategoryPolicy;
use App\Policies\Student\CoursePolicy;
use App\Policies\Student\CourseStudentPolicy;
use App\Policies\Student\StudentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Category::class => CategoryPolicy::class,
        Student::class => StudentPolicy::class,
        Course::class => CoursePolicy::class,
        CourseStudent::class => CourseStudentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
