<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(mixed $validated)
 * @method static findOrFail(Product $product)
 */
class Product extends Model
{

    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'available_quantity',
        'category_id',
    ];

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }
    public function user() : BelongsTo {
            return $this->belongsTo(User::class);
        }

    public function outproducts() : HasMany {
        return $this->hasMany(Outproduct::class);
    }

    public function enterproducts() : HasMany
    {
        return $this->hasMany(Enterproduct::class);
    }

}
