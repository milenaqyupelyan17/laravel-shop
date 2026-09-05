<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'title' => 'Mango',
            'description' => 'Kimono & Caftan - Black - Regular fit',
            'price' => 215,
            'image' => 'images/top-1.jpg',
        ]);

        Product::create([
            'title' => 'Zara',
            'description' => 'Midi top- Daily fit',
            'price' => 125,
            'image' => 'images/top-2.jpg',
        ]);

        Product::create([
            'title' => 'beige coat Zara',
            'description' => 'Cream-Brown-Formal',
            'price' => 398,
            'image' => 'images/top-3.jpg',
        ]);

        Product::create([
            'title' => 'Mango dress',
            'description' => 'Kimono & Caftan - Colorful - Night club fit',
            'price' => 68,
            'image' => 'images/top-4.jpg',
        ]);

        Product::create([
            'title' => 'Ralph Lauren',
            'description' => 'Blouse - Minimalist',
            'price' => 300,
            'image' => 'images/top-5.png',
        ]);

        Product::create([
            'title' => 'NBB',
            'description' => 'Bikini & seaside - Casual',
            'price' => 512,
            'image' => 'images/top-6.png',
        ]);

        Product::create([
            'title' => 'Rachel Pally',
            'description' => 'Dress - Beige - Shift - Casual',
            'price' => 259,
            'image' => 'images/top-7.png',
        ]);

        Product::create([
            'title' => 'Ralph Lauren',
            'description' => 'Shirt-oversize - Minimalist',
            'price' => 420,
            'image' => 'images/top-8.png',
        ]);

        Product::create([
            'title' => 'Zara',
            'description' => 'Sweater - Black & White - Minimalist',
            'price' => 228,
            'image' => 'images/top-9.png',
        ]);

        Product::create([
            'title' => 'Uniqlo',
            'description' => 'Sweater - Casual',
            'price' => 230,
            'image' => 'images/top-10.png',
        ]);
    }
}