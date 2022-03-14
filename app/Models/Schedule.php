<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'location_id',
        'shift_id',
        'date',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'schedule_user', 'schedule_id', 'user_id')
                    ->withPivot(['trainer_id', 'status', 'note'])->withTimestamps();
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id', 'id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


}
