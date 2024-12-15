<?php

namespace App\Models;

use Database\Factories\EnterproductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(mixed $validated)
 * @method static sum(string $string)
 */
class Enterproduct extends Model
{

    protected $fillable = [
        'quantity',
        'product_id',
    ];

    public function product() : BelongsTo {
        return $this->belongsTo(Product::class);
    }


    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
