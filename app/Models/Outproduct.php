<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(mixed $validated)
 * @method static findOrFail(Outproduct $outproduct)
 */
class Outproduct extends Model
{

//    protected $table = 'outproduct';

    protected $fillable = [
        'quantity',
        'product_id',
    ];

    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

}
