<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Blog extends Model
{
    protected $fillable = [
        'title','slug','content','image','status'
    ];

// 

public function comments()
{
    return $this->hasMany(Comment::class)
                ->where('status',1) // ✅ only approved
                ->latest();
}


}
