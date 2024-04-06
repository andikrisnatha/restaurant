<?php

namespace Database\Seeders;

use App\Models\CategorySands;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'description' => 'Salads'
            ],
            [
                'description' => 'Chef&#39;s Basket'
            ],
            [
                'description' => 'Soup'
            ],
            [
                'description' => 'Main Courses'
            ],
            [
                'description' => 'From The Grill'
            ],
            [
                'description' => 'Fish'
            ],
            [
                'description' => 'Pastas & Pizzaz'
            ],
            [
                'description' => 'Sandwhiches & Burgers'
            ],
            [
                'description' => 'Sushi Delight'
            ],
            [
                'description' => 'Wok Delight'
            ],
            [
                'description' => 'For the Little Ones'
            ],
            [
                'description' => 'Desserts'
            ],
        ];

        CategorySands::insert($categories);
    }
}
