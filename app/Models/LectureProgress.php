<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LectureProgress extends Model
{
    use HasFactory;

    protected $table = 'lecture_progress';

    protected $fillable = [
        'user_id',
        'lecture_id',
        'is_completed'
    ];

    // 🔗 RELATION: User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 RELATION: Lecture
    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}
