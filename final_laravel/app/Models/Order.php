<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

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
        'total_price'
    ];

    /**
     * Liên kết tới các sản phẩm trong đơn hàng (OrderItem).
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }

    /**
     * Liên kết tới người dùng.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
