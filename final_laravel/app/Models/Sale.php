<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'name',
        'sale_target',
        'percentage',
        'start_date',
        'end_date',
    ];

    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'name', 'name');
    }
    public function collection()
    {
        return $this->hasOne(Collection::class, 'name', 'name');
    }
}
