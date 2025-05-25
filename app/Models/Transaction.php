<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'expense_id',
        'transaction_type',
        'transaction_amount',
        'transaction_method',
        'transaction_for',
    ];

    // Relation to user model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation to expense model
    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }
}
