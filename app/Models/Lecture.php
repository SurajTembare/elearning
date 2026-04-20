<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
   protected $fillable = [
    'course_id',
    'title',
    'type',
    'file_path',
    'video_file'
];
//   public function course()
//     {
//         return $this->belongsTo(Course::class);
//     }
}
