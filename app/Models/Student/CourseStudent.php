<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseStudent extends Model
{
    use HasFactory;


    public function course():BelongsTo{
        return $this->belongsTo(Course::class);
    }
    public function student():BelongsTo{
        return $this->belongsTo(Student::class);
    }
}
