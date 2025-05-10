<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

// Add these import statements for the related models

//use App\Models\Enquiry;
//use App\Models\Feedback;
//use App\Models\Survey;
//use App\Models\SurveyResponse;
//use App\Models\Ticket;
//use App\Models\Message;
//use App\Models\Attachment;
//use App\Models\AutomatedResponse;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }

    public function assignedEnquiries()
    {
        return $this->hasMany(Enquiry::class, 'assigned_to');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function createdSurveys()
    {
        return $this->hasMany(Survey::class, 'creator_id');
    }

    public function surveyResponses()
    {
        return $this->hasMany(SurveyResponse::class, 'respondent_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_agent_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'uploaded_by');
    }

    public function automatedResponses()
    {
        return $this->hasMany(AutomatedResponse::class, 'created_by');
    }
    
    
    // Optional: helper methods for role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAgent()
    {
        return $this->role === 'agent';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }
}