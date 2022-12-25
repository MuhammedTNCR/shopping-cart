<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://dummyjson.com/products?limit=10&&select=title,price&search=phone');
        $products = json_decode($response->body(), true);
        foreach ($products['products'] as $product) {
            Product::create([
                'image' => str_replace(' ', '_', $product['title'].'.'.'png'),
                'title' => $product['title'],
                'price' => $product['price']
            ]);
        }
    }
}
