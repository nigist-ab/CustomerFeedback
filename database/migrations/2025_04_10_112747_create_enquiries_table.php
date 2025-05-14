<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')  // Foreign key referencing users table
            ->constrained('users')  // Points to the 'users' table
            ->onDelete('cascade');  // Delete related enquiry if user is deleted
            $table->string('subject');  // Subject of the enquiry
            $table->text('message');  // The enquiry message
            $table->enum('status', ['open', 'in-progress', 'resolved'])->default('open');  // Enquiry status
            $table->foreignId('assigned_to')  // Foreign key to another user (agent assigned to resolve enquiry)
                ->nullable()  // Can be null initially
                ->constrained('users')  // Points to the 'users' table (agent)
                ->onDelete('set null');  // Set to null if agent is deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
