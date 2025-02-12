<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ProductTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test listing products.
     */
    public function test_can_list_products()
    {
        Product::factory()->count(5)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'image', 'description', 'price', 'stock', 'created_at', 'updated_at']
                ],
                'pagination',
            ]);
    }

    /**
     * Test creating a product.
     */
    public function test_can_create_product()
    {
        $productData = [
            'name' => 'Test Product',
            'image' => 'test_image.jpg',
            'description' => 'This is a test product',
            'price' => 100,
            'stock' => 10,
        ];

        $response = $this->postJson('/api/products', $productData);

        $response->assertStatus(201)
            ->assertJsonFragment($productData);

        $this->assertDatabaseHas('products', $productData);
    }

    /**
     * Test showing a product.
     */
    public function test_can_show_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
            ]);
    }

    /**
     * Test updating a product.
     */
    public function test_can_update_product()
    {
        $product = Product::factory()->create();

        $updatedData = [
            'name' => 'Updated Product',
            'image' => 'updated_image.jpg',
            'description' => 'This is an updated product',
            'price' => 150,
            'stock' => 20,
        ];

        $response = $this->putJson("/api/products/{$product->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('products', $updatedData);
    }

    /**
     * Test deleting a product.
     */
    public function test_can_delete_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
