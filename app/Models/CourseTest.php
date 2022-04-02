<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTest extends Model
{
    use HasFactory;
    protected $table = 'test_course';
    protected $fillable = [
        'test_id',
        'course_id',
        'date',
        'question_limit',
        'start_time',
        'end_time',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'test_user', 'test_course_id', 'user_id')
                    ->withPivot(['exam','submit', 'result'])->withTimestamps();
    }
    
}
