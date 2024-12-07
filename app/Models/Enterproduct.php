<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enterproduct extends Model
{
    /** @use HasFactory<\Database\Factories\EnterproductFactory> */
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_id',
    ];

    public function product() : BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
