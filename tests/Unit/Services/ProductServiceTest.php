<?php

namespace Services;

use App\Models\Products;
use App\Models\User;
use App\Services\ProductService;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class ProductServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @throws Exception
     */
    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $product = factory(Products::class)->create(['user_id' => $user->id]);

        $product = (new ProductService())->update($product->id, [
            'user_id' => $user->id,
            'name' => 'product two',
            'price' => 40,
            'inventory' => 50,
            'img_path' => UploadedFile::fake()->image('avatar200.jpg')
        ]);

        $this->assertDatabaseHas('products', $product->only([
            'user_id',
            'name',
            'price',
            'inventory',
            'img_path'
        ]));
    }

    /**
     * @throws Exception
     */
    public function testCreate()
    {
        $user = factory(User::class)->create();

        $product = (new ProductService())->create([
            'user_id' => $user->id,
            'name' => 'product one',
            'price' => 23.43,
            'inventory' => 40,
            'img_path' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        $this->assertDatabaseHas('products', $product->only([
            'user_id',
            'name',
            'price',
            'inventory',
            'img_path'
        ]));
    }
}
