<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Services\AiAnalysisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ComplaintController extends Controller
{
    protected $aiService;

    public function __construct()
    {
        // Temporarily remove AiAnalysisService dependency
        $this->aiService = null;
    }

    /**
     * Display a listing of complaints
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // if ($user->hasRole('Admin')) {
        //     // Admin sees all complaints
        //     $complaints = Complaint::with('user')->latest()->paginate(10);
        // } elseif ($user->hasRole('Manager')) {
        //     // Manager sees all complaints
        //     $complaints = Complaint::with('user')->latest()->paginate(10);
        // } else {
        //     // Regular users see only their complaints
        //     $complaints = Complaint::where('user_id', $user->id)->latest()->paginate(10);
        // }
        $complaints = Complaint::where('user_id', $user->id)->latest()->paginate(10);

        return view('complaints.index', compact('complaints'));
    }

    /**
     * Show the form for creating a new complaint
     */
    public function create()
    {
        if (!Auth::user()->can('create complaints')) {
            abort(403, 'Unauthorized action.');
        }

        return view('complaints.create');
    }

    /**
     * Store a newly created complaint
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('create complaints')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Use default AI result for now
        $aiResult = [
            'sentiment' => 'neutral',
            'confidence' => 0.5,
            'category' => $validated['category'] ?? 'other',
            'urgency' => 'low'
        ];

        $complaint = Complaint::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

        return redirect()->route('complaints.show', $complaint)->with('success', 'Complaint Created Successfully');
    }

    /**
     * Display the specified complaint
     */
    public function show(Complaint $complaint)
    {
        $user = Auth::user();

        if (!$user->hasRole('Admin') && !$user->hasRole('Manager') && $complaint->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('complaints.show', $complaint, compact('complaint'));
    }

    /**
     * Show the form for editing the specified complaint
     */
    public function edit(Complaint $complaint)
    {
        $user = Auth::user();

        // Check if user can edit this complaint
        if (!$user->hasRole('Admin') && !$user->hasRole('Manager')) {
            abort(403, 'Unauthorized action.');
        }

        return view('complaints.edit', compact('complaint'));
    }

    /**
     * Update the specified complaint
     */
    public function update(Request $request, Complaint $complaint)
    {
        $user = Auth::user();

        // Check if user can edit this complaint
        if (!$user->hasRole('Admin') && !$user->hasRole('Manager')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|in:service,billing,product,other',
            'status' => 'required|string|in:pending,in-progress,resolved',
        ]);

        $complaint->update($validated);

        return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully!');
    }

    /**
     * Remove the specified complaint
     */
    public function destroy(Complaint $complaint)
    {
        if (!Auth::user()->hasRole('Admin')) {
            abort(403, 'Unauthorized action.');
        }

        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully!');
    }
}
