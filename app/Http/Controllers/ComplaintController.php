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

    public function __construct(AiAnalysisService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $aiResult = $this->aiService->analyze($validated['description']);

        $complaint = Complaint::create([
            'user_id' => Auth::id(), // Use Auth facade for better Intelephense recognition
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $aiResult['category'] ?? 'other',
            'ai_analysis' => $aiResult,
        ]);

        return redirect()->route('complaints.index')->with('success', 'Complaint submitted successfully!');
    }
}
