<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'sessions',
        'category_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Profile::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
