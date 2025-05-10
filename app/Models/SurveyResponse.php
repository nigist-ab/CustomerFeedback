<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id', 'respondent_id', 'submitted_at', 'ip_address',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function respondent()
    {
        return $this->belongsTo(User::class, 'respondent_id');
    }

    // A response can have many answers
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
