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
        'category',
        'status',
        'ai_analysis',
        'user_id',
    ];

    protected $casts = [
        'ai_analysis' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
