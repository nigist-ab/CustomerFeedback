<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutomatedResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'trigger_keyword', 'response_text', 'is_active', 'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
