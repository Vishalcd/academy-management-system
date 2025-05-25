<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'shop_details',
        'payment_type',
        'unit_price',
        'quantity',
        'total_price',
        'photo',
        'payment_settled'
    ];

    // Relation to transaction Model
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
