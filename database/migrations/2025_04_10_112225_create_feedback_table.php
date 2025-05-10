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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')  // Foreign key referencing the user who gave the feedback
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('survey_id')  // Foreign key to a specific survey
                ->nullable()  // Can be null if no survey is linked
                ->constrained('surveys')
                ->onDelete('cascade');
            $table->text('message');  // The feedback message
            $table->integer('rating')->nullable();  // Optional rating (e.g., 1-5)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
