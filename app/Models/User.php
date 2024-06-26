<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * 
     
     * @var array
     * 
     */
    protected $fillable = [
        'full_name', 'email', 'password', 'phone', 'address'
    ];

    /**   
     *  @var array
*/

protected $casts = [
    'favorites' => 'array', // Chuyển đổi thuộc tính favorites từ JSON sang mảng
];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $cast = [
        'email_verified_at' => 'datetime',
    ];
    public function addToFavorites($productId)
    {
        $favorites = $this->favorites ?? [];
        if (!in_array($productId, $favorites)) {
            $favorites[] = $productId;
            $this->favorites = $favorites;
            $this->save();
        }
    }

    public function removeFromFavorites($productId)
    {
        $favorites = $this->favorites ?? [];
        if (in_array($productId, $favorites)) {
            $favorites = array_diff($favorites, [$productId]);
            $this->favorites = $favorites;
            $this->save();
        }
    }

    public function getFavoritesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setFavoritesAttribute($value)
    {
        $this->attributes['favorites'] = json_encode($value);
    }
    
}
