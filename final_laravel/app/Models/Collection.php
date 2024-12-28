<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Collection extends Model
{
    use Sluggable;
    protected $fillable = ['name', 'description', 'slug'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'name', 'name');
    }
}
