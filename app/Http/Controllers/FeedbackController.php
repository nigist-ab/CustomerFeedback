<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Survey;

class FeedbackController extends Controller
{
    //Show all feedback entries (for the logged-in user)
    public function index()
    {
        $feedback = Feedback::with(['user', 'survey', 'product'])->latest()->get();

        return Inertia::render('Feedback/Index', [
            'feedbacks' => $feedback
        ]);
    }

    // 🟢 Show create feedback form
    public function create()
    {
        $products = product::all();
        $surveys = survey::all();
        return Inertia::render('Feedback/Create', [
            'products' => $products,
            'surveys' => $surveys 
        ]);
        
    }

    // 🟢 Store new feedback in DB
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id', // Ensure product_id is validated
            'survey_id' => 'nullable|exists:surveys,id',
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        // Debugging: Log the validated data
        Log::info('Validated Data:', $validated);

        Feedback::create([
            'user_id' => Auth::id(),
            'product_id' => $validated['product_id'], // Save the product ID
            'survey_id' => $validated['survey_id'],
            'message' => $validated['message'],
            'rating' => $validated['rating'] ?? null,
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback submitted successfully.');
    }

    // 🟢 Show edit form
    public function edit(Feedback $feedback)
    {
        $products = Product::all();
        $surveys = Survey::all();

        return Inertia::render('Feedback/Edit', [
            'feedback' => $feedback,
            'products' => $products,
            'surveys' => $surveys,
        ]);
    }

    // 🟢 Update feedback in DB
    public function update(Request $request, Feedback $feedback)
    {
        //if ($feedback->user_id !== Auth::id()) {
            //abort(403); }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'survey_id' => 'required|exists:surveys,id',
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $feedback->update($validated);

        return redirect()->route('feedback.index')->with('success', 'Feedback updated successfully.');
    }

    // 🟢 Delete feedback
    public function destroy(Feedback $feedback)
    {
        //if ($feedback->user_id !== Auth::id()) {
            //abort(403);}

        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Feedback deleted.');
    }

    // Customer: Submit feedback
    public function submitFeedback(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id', // ✅ add this
            'survey_id' => 'nullable|exists:surveys,id',
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'product_id' => $request->input('product_id'),
            'survey_id' => $request->input('survey_id'),
            'message' => $request->input('message'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback submitted successfully.');
    }

    // Admin/Agent: View all feedback
    public function viewFeedback()
    {
        $feedback = Feedback::with(['user', 'survey', 'product'])->get();
         return Inertia::render('Feedback/Index', [
        'feedbacks' => $feedback
    ]);
    }

    // Customer: View own feedback
    public function viewOwnFeedback()
    {
        $feedback = Feedback::where('user_id', Auth::id())->with(['survey', 'product'])->get();
        return Inertia::render('Feedback/Own', [
        'feedbacks' => $feedback
    ]);
    }

    // 🟢 Show individual feedback
    public function show(Feedback $feedback)
    {
        return Inertia::render('Feedback/Show', [
            'feedback' => $feedback->load(['user', 'survey', 'product']),
        ]);
    }
}
