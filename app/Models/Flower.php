<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    protected $fillable = ['name', 'color', 'price', 'stock', 'image'];

    public function bouquets()
    {
        return $this->belongsToMany(Bouquet::class, 'bouquet_flowers')
                    ->withPivot('quantity');
    }
}