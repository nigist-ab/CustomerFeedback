<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->renameColumn('response_id', 'survey_response_id');
            $table->renameColumn('question_id', 'survey_question_id');
        });
    }

    public function down(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->renameColumn('survey_response_id', 'response_id');
            $table->renameColumn('survey_question_id', 'question_id');
        });
    }
};
