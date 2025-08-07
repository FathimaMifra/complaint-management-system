<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class SubmitComplaint extends Component
{
    public $title;
    public $description;
    public $due_date;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'due_date' => 'nullable|date',
    ];

    public function submit()
    {
        $this->validate();

        Complaint::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'status' => 'Pending',
            'priority' => null, // Will be set by AI
            'sentiment' => null, // Will be set by AI
        ]);

        session()->flash('message', 'Complaint submitted successfully!');
        $this->reset(['title', 'description', 'due_date']);
    }
    
    public function render()
    {
        return view('livewire.submit-complaint');
    }
}
