<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'job_title',
        'salary',
        'pending_salary',
        'last_paid',
        'salary_settled',
    ];

    // Relation to user model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
