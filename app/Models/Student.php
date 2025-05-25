<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'class',
        'section',
        'section',
        'fees_due',
        'fees_settle',
        'created_at'
    ];

    // Relation to user Model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
