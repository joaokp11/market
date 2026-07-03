<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Saffron Street Sneakers',
                'slug' => 'saffron-street-sneakers',
                'category' => 'Footwear',
                'description' => 'A lightweight sneaker built for everyday comfort and bold style.',
                'price' => 89.99,
                'image_url' => 'https://images.unsplash.com/photo-1519741490812-6ef1f4ee2dcf?auto=format&fit=crop&w=900&q=80',
                'inventory' => 24,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sunstone Wireless Earbuds',
                'slug' => 'sunstone-wireless-earbuds',
                'category' => 'Audio',
                'description' => 'Crisp sound with ambient mode and all-day battery in a sunset orange finish.',
                'price' => 129.00,
                'image_url' => 'https://images.unsplash.com/photo-1518449037092-0d65070c7aa8?auto=format&fit=crop&w=900&q=80',
                'inventory' => 48,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amber Luxe Backpack',
                'slug' => 'amber-luxe-backpack',
                'category' => 'Accessories',
                'description' => 'A premium travel backpack with padded compartments and soft orange leather accents.',
                'price' => 74.50,
                'image_url' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=900&q=80',
                'inventory' => 17,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mango Glow Skincare Set',
                'slug' => 'mango-glow-skincare-set',
                'category' => 'Beauty',
                'description' => 'Nourishing skincare essentials with mango extract for a fresh, radiant finish.',
                'price' => 42.00,
                'image_url' => 'https://images.unsplash.com/photo-1580910051074-58ee9da7accd?auto=format&fit=crop&w=900&q=80',
                'inventory' => 31,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Citrus Dash Watch',
                'slug' => 'citrus-dash-watch',
                'category' => 'Wearables',
                'description' => 'Sporty smartwatch with activity tracking and a bright orange strap.',
                'price' => 159.95,
                'image_url' => 'https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?auto=format&fit=crop&w=900&q=80',
                'inventory' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tangerine Desk Lamp',
                'slug' => 'tangerine-desk-lamp',
                'category' => 'Home',
                'description' => 'Modern LED desk lamp with adjustable warmth and a vibrant matte finish.',
                'price' => 54.20,
                'image_url' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
                'inventory' => 39,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
