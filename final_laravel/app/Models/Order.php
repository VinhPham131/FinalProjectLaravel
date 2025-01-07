<?php
namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

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
        'code',
        'status', // Add status to fillable
    ];

    protected $attributes = [
        'status' => 'packaging', // Set default status to packaging
    ];

    /**
     * Liên kết tới các sản phẩm trong đơn hàng (OrderItem).
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
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

    /**
     * Set the status attribute.
     */
    public function setStatusAttribute($value)
    {
        $allowedStatuses = ['packaging', 'shipping', 'shipped'];

        if (!in_array($value, $allowedStatuses)) {
            throw new \InvalidArgumentException("Invalid status: $value");
        }

        $this->attributes['status'] = $value;
    }
}
