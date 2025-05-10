<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    // A Product has many Feedbacks
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
