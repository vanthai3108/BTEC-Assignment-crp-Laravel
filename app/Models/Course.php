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
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
