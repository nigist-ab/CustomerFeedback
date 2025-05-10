<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'creator_id', 'status', 'start_date', 'end_date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    // A survey can have many questions
    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class);
    }

    // A survey can have many responses
    public function responses()
    {
        return $this->hasMany(SurveyResponse::class);
    }
}
