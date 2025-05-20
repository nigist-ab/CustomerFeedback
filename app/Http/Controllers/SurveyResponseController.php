<?php

namespace App\Http\Controllers;

use App\Models\SurveyResponse;
use App\Models\Answer;
use App\Models\SurveyQuestion;
use App\Models\Survey;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SurveyResponseController extends Controller
{
    // List all survey responses
    public function index()
    {
        $responses = SurveyResponse::with(['survey', 'respondent'])
            ->orderBy('submitted_at', 'desc')
            ->get();
        return Inertia::render('SurveyResponses/Index', [
            'responses' => $responses,
        ]);
    }

    // Show the form to create a new survey response
    public function create()
    {
        return Inertia::render('SurveyResponses/Create');
    }

    // Show a single survey response
    public function show($id)
    {
        $response = SurveyResponse::with(['survey', 'respondent', 'answers'])->findOrFail($id);
        return Inertia::render('SurveyResponses/Show', [
            'response' => $response,
        ]);
    }

    // Show the form to fill a survey (with questions)
    public function fill(Survey $survey)
    {
        $questions = SurveyQuestion::where('survey_id', $survey->id)->orderBy('order')->get();
        return Inertia::render('Surveys/Fill', [
            'survey' => $survey,
            'questions' => $questions,
        ]);
    }

    // Store a new survey response
    public function store(Request $request)
    {
        $data = $request->validate([
            'survey_id' => 'required|exists:surveys,id',
            'respondent_id' => 'nullable|exists:users,id',
            'ip_address' => 'nullable|ip',
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:survey_questions,id',
            'answers.*.value' => 'nullable',
        ]);

        $data['submitted_at'] = now();

        $response = SurveyResponse::create($data);

        foreach ($data['answers'] as $answerData) {
            $question = SurveyQuestion::find($answerData['question_id']);
            $value = $answerData['value'];

            if ($question->question_type === 'checkbox') {
                // Ensure value is array, then encode as JSON
                $value = json_encode(is_array($value) ? $value : []);
            }

            Answer::create([
                'survey_response_id' => $response->id,
                'survey_question_id' => $question->id,
                'value' => $value,
            ]);
        }

        return redirect()->route('survey-responses.show', $response->id)
            ->with('success', 'Survey response submitted successfully.');
    }
}
