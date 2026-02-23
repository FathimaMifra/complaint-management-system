<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'ai_analysis',
        'sentiment',
        'priority',
        'user_id',
        'due_date',
    ];
    protected $casts = [
        'ai_analysis' => 'array',
        'due_date' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class); // Ensure User model is imported
    }

}
