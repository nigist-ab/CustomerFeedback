<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyQuestion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SurveyQuestionController extends Controller
{
    public function index(Survey $survey): Response
    {
        return Inertia::render('SurveyQuestions/Index', [
            'survey' => $survey->load('questions'),
        ]);
    }

    public function create(Survey $survey): Response
    {
        return Inertia::render('SurveyQuestions/Create', [
            'survey' => $survey,
        ]);
    }

    public function store(Request $request, Survey $survey)
    {
        $data = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple-choice,text,rating',
            'options' => 'nullable|array',
            'is_required' => 'boolean',
            'order' => 'integer',
        ]);

        $data['survey_id'] = $survey->id;
        // Convert options to JSON only for multiple-choice
    if ($data['question_type'] === 'multiple-choice') {
        $data['options'] = json_encode($data['options']);
    } else {
        $data['options'] = null;
    }

        SurveyQuestion::create($data);

        return redirect()->route('surveys.questions.index', $survey->id)->with('success', 'Question added!');
    }

    public function edit(SurveyQuestion $question): Response
    {
        return Inertia::render('SurveyQuestions/Edit', [
            'question' => $question,
        ]);
    }

    public function update(Request $request, SurveyQuestion $question)
    {
        $data = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple-choice,text,rating',
            'options' => 'nullable|array',
            'is_required' => 'boolean',
            'order' => 'integer',
        ]);

        if ($data['question_type'] !== 'multiple-choice') {
            $data['options'] = null;
        }

        $question->update($data);

        return redirect()->route('surveys.questions.index', $question->survey_id)->with('success', 'Question updated!');
    }

    public function destroy(SurveyQuestion $question)
    {
        $question->delete();

        return back()->with('success', 'Question deleted.');
    } 
}
