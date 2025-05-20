<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the enquiries.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'agent') {
            // Show only enquiries assigned to the logged-in agent
            $enquiries = Enquiry::with(['user', 'assignedAgent'])
                ->where('assigned_to', $user->id)
                ->latest()
                ->get();
        } elseif ($user->role === 'admin') {
            // Admin sees all enquiries
            $enquiries = Enquiry::with(['user', 'assignedAgent'])->latest()->get();
        } else {
            // Customer sees only their own enquiries
            $enquiries = Enquiry::with(['user', 'assignedAgent'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        }

        $agents = User::where('role', 'agent')->get(); // Fetch agents for assignment

        return Inertia::render('Enquiries/Index', [
            'enquiries' => $enquiries,
            'agents' => $agents,
            'isAgent' => $user->role === 'agent', // Pass isAgent to frontend
            'isAdmin' => $user->role === 'admin', // Pass isAdmin to frontend
        ]);
    }

    /**
     * Show the form for creating a new enquiry.
     */
    public function create()
    {
        return Inertia::render('Enquiries/Create');
    }

    /**
     * Store a newly created enquiry in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Enquiry::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open', // Default status
        ]);

        return redirect()->route('enquiries.index')->with('success', 'Enquiry created successfully.');
    }

    /**
     * Show the form for editing the specified enquiry.
     */
    public function edit(Enquiry $enquiry)
    {
        $agents = User::where('role', 'agent')->get(); // Fetch agents for assignment

        return Inertia::render('Enquiries/Edit', [
            'enquiry' => $enquiry,
            'agents' => $agents,
        ]);
    }

    /**
     * Show the details of the specified enquiry.
     */
    public function show(Enquiry $enquiry)
    {
        $enquiry->load(['user', 'assignedAgent']); // Load related user and assigned agent

        return Inertia::render('Enquiries/Show', [
            'enquiry' => $enquiry,
             'auth' => ['user' => Auth::user()],
        ]);
    }

    /**
     * Update the specified enquiry in storage.
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:open,in-progress,resolved',
            'assigned_to' => 'nullable|exists:users,id',
            'response' => 'nullable|string',
        ]);

        $enquiry->update([
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
            'response' => $request->response,
        ]);

        return redirect()->route('enquiries.index')->with('success', 'Enquiry updated successfully.');
    }

    /**
     * Assign an enquiry to an agent.
     */
    public function assign(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id', // Ensure the selected agent exists
        ]);

        $enquiry->update([
            'assigned_to' => $request->assigned_to,
            'status' => 'in-progress', // Update status to "in-progress"
        ]);

        return redirect()->route('enquiries.index')->with('success', 'Enquiry assigned successfully.');
    }

    /**
     * Store agent's response to an enquiry.
     */
    public function respond(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'response' => 'required|string',
        ]);

        // Only assigned agent can respond
        if (Auth::id() !== $enquiry->assigned_to) {
            abort(403, 'Unauthorized');
        }

        $enquiry->update([
            'response' => $request->response,
            'status' => 'resolved', // Optionally mark as resolved
        ]);

        return redirect()->route('enquiries.index')->with('success', 'Response submitted.');
    }

    /**
     * Resolve the specified enquiry.
     */
    public function resolve(Enquiry $enquiry)
    {
        $enquiry->update(['status' => 'resolved']);

        return redirect()->route('enquiries.index')->with('success', 'Enquiry resolved successfully.');
    }

    /**
     * Remove the specified enquiry from storage.
     */
    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return redirect()->route('enquiries.index')->with('success', 'Enquiry deleted.');
    }
}