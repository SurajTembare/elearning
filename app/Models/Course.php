<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{


 protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'price',
        'is_paid'
    ];
    
    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    
}
