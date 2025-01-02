<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'country',
        'address',
        'phone',
        'note',
        'payment',
        'total_price',
        'code'
    ];

    /**
     * Liên kết tới các sản phẩm trong đơn hàng (OrderItem).
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }
    protected static function booted()
    {
        static::creating(function ($order) {
            $order->code = 'ID-' . strtoupper(Str::random(8));
        });
    }

    /**
     * Liên kết tới người dùng.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
