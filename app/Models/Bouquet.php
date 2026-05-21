<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Bouquet extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'price', 'image', 'is_available'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function flowers()
    {
        return $this->belongsToMany(Flower::class, 'bouquet_flowers')
                    ->withPivot('quantity');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}