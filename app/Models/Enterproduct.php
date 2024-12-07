<?php

namespace App\Models;

use Database\Factories\EnterproductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(mixed $validated)
 */
class Enterproduct extends Model
{
    /** @use HasFactory<EnterproductFactory> */
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_id',
    ];

    public function product() : BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
