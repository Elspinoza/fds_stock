<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Outproduct extends Model
{
    /** @use HasFactory<\Database\Factories\OutproductFactory> */
    use HasFactory;

    protected $table = 'outproduct';

    protected $fillable = [
        'quantity',
        'product_id',
    ];

    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
}
