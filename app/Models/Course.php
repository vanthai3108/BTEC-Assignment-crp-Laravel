<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subject_id',
        'class_id',
        'semester_id',
        'trainer_id',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
                    ->withPivot(['score', 'status'])->withTimestamps();;
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function class()
    {
        return $this->belongsTo(Classs::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
