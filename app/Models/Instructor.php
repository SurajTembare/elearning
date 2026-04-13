<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'bio',
        'image'
    ];


    public function instructor()
{
    return $this->belongsTo(Instructor::class);
}


}
