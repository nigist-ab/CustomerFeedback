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
        $enquiries = Enquiry::with(['user', 'assignedAgent'])->latest()->get(); // Ensure 'assignedAgent' is loaded
        $agents = User::where('role', 'agent')->get(); // Fetch agents for assignment

        return Inertia::render('Enquiries/Index', [
            'enquiries' => $enquiries,
            'agents' => $agents,
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
     * Update the specified enquiry in storage.
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:open,in-progress,resolved',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $enquiry->update([
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('enquiries.index')->with('success', 'Enquiry updated successfully.');
    }

    /**
     * Assign an enquiry to an agent.
     */
    public function assign(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $enquiry->update([
            'assigned_to' => $request->assigned_to,
            'status' => 'in-progress',
        ]);

        return redirect()->route('enquiries.index')->with('success', 'Enquiry assigned successfully.');
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