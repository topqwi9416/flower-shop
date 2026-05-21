<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'customer_name', 'customer_phone',
        'delivery_address', 'delivery_time', 'total_amount',
        'status', 'comment'
    ];

    protected $casts = [
        'delivery_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Пересчёт суммы заказа
    public function recalculateTotal()
    {
        $total = $this->items->sum(fn($item) => $item->price * $item->quantity);
        $this->update(['total_amount' => $total]);
    }
}