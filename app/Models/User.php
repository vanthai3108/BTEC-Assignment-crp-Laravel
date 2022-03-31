<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'avatar',
        'google_id',
        'status',
        'role_id',
        'campus_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image()
    {
        return $this->avatar;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    public function coursesTrainer()
    {
        return $this->hasMany(Course::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id')
                    ->withPivot(['score', 'status'])->withTimestamps();
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'schedule_user', 'user_id', 'schedule_id')
                    ->withPivot(['trainer_id','status', 'note'])->withTimestamps();
    }

    public function courseTest()
    {
        return $this->belongsToMany(CourseTest::class, 'test_user', 'user_id', 'test_course_id')
                    ->withPivot(['exam','submit', 'result'])->withTimestamps();
    }
}
