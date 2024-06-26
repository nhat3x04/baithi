<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id'];

    /**
     * Relationship: One-to-One (Inverse)
     * A favorite belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: One-to-One (Inverse)
     * A favorite belongs to a product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function addToFavorites($productId)
    {
        if (!$this->favorites()->where('product_id', $productId)->exists()) {
            $this->favorites()->create(['product_id' => $productId]);
        }
    }

    public function removeFromFavorites($productId)
    {
        $favorite = $this->favorites()->where('product_id', $productId)->first();
        if ($favorite) {
            $favorite->delete();
        }
    }
}
