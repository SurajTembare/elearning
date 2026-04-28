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
        'is_paid',
        'offer_name',
        'discount_percent',
        'discount_start',
        'discount_end',
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

    //   // ✅ CHECK IF OFFER ACTIVE
    // public function getIsDiscountActiveAttribute()
    // {
    //     if (!$this->discount_percent || !$this->discount_start || !$this->discount_end) {
    //         return false;
    //     }

    //     return now()->between(
    //         \Carbon\Carbon::parse($this->discount_start),
    //         \Carbon\Carbon::parse($this->discount_end)
    //     );
    // }
public function getIsDiscountActiveAttribute()
{
    if (!$this->discount_percent || !$this->discount_start || !$this->discount_end) {
        return false;
    }

    $today = now()->toDateString();

    return $today >= $this->discount_start && $today <= $this->discount_end;
}
    // ✅ FINAL PRICE AFTER DISCOUNT
    public function getFinalPriceAttribute()
    {
        if ($this->is_discount_active) {
            return $this->price - ($this->price * $this->discount_percent / 100);
        }

        return $this->price;
    }
}
