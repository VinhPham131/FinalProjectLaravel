<?php

namespace Tests\Traits;

use App\Models\Collection;
use App\Models\Contact;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use App\Models\User;

trait TestHelpers
{
    protected function createAdmin()
    {
        return User::factory()->create(['role' => 'admin']);
    }

    protected function createUser()
    {
        return User::factory()->create(['role' => 'user']);
    }

    protected function createCollection($attributes = [])
    {
        return Collection::factory()->create($attributes);
    }

    protected function createContact($attributes = [])
    {
        return Contact::factory()->create($attributes);
    }

    protected function createProductCategory($attributes = [])
    {
        return ProductCategory::factory()->create($attributes);
    }

    protected function createProduct($attributes = [])
    {
        return Product::factory()->create($attributes);
    }

    protected function createSale($attributes = [])
    {
        return Sale::factory()->create($attributes);
    }

    protected function actingAsAdmin()
    {
        return $this->actingAs($this->createAdmin(), 'sanctum');
    }

    protected function actingAsUser()
    {
        return $this->actingAs($this->createUser(), 'sanctum');
    }
}
