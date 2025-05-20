<?php

namespace App\Http\Controllers;

use App\Models\SurveyQuestion;
use App\Models\Survey;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SurveyQuestionController extends Controller
{
    // Show all questions for a survey
    public function index(Survey $survey)
    {
        $questions = SurveyQuestion::where('survey_id', $survey->id)->orderBy('order')->get();

        return Inertia::render('SurveyQuestions/Index', [
            'survey' => $survey,
            'questions' => $questions,
        ]);
    }

    // Show create question form
    public function create(Survey $survey)
    {
        return Inertia::render('SurveyQuestions/Create', [
            'survey' => $survey,
        ]);
    }

    // Store new question
    public function store(Request $request, Survey $survey)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string',
            'options' => 'nullable|array',
            'is_required' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['survey_id'] = $survey->id;
        //if (isset($validated['options'])) {
          //  $validated['options'] = json_encode($validated['options']);
        //}

        SurveyQuestion::create($validated);

        return redirect()->route('surveys.questions.index', $survey->id)
            ->with('success', 'Question created successfully.');
    }

    // Show edit form
    public function edit(Survey $survey, SurveyQuestion $question)
    {
        return Inertia::render('SurveyQuestions/Edit', [
            'survey' => $survey,
            'question' => $question,
        ]);
    }

    // Update question
    public function update(Request $request, Survey $survey, SurveyQuestion $question)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string',
            'options' => 'nullable|array',
            'is_required' => 'boolean',
            'order' => 'integer',
        ]);

       // if (isset($validated['options'])) {
         //   $validated['options'] = json_encode($validated['options']);
       // }

        $question->update($validated);

        return redirect()->route('surveys.questions.index', $survey->id)
            ->with('success', 'Question updated successfully.');
    }

    // Delete question
    public function destroy(Survey $survey, SurveyQuestion $question)
    {
        $question->delete();

        return redirect()->route('surveys.questions.index', $survey->id)
            ->with('success', 'Question deleted successfully.');
    }

    // Show individual question (optional, for completeness)
    public function show(Survey $survey, SurveyQuestion $question)
    {
        return Inertia::render('SurveyQuestions/Show', [
            'survey' => $survey,
            'question' => $question,
        ]);
    }
}
