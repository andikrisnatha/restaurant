<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotions = [
         [
            'title' => 'Guardian of the Ocean',
            'price' => 'IDR 100.000/net',
            'description' => 'A legendary cocktail blend that combines bold flavors from across the universe.',
            'image' => 'https://www.theanvayabali.com/wp-content/uploads/2023/05/GOTO-960x700-1.jpg',
            'status' => true,
         ],
         [
            'title' => 'Tropical Breeze',
            'price' => 'IDR 50.000++',
            'description' => 'The refreshing drink from the tropical island to quench your thirst while soaking up the sun.',
            'image' => 'https://www.theanvayabali.com/wp-content/uploads/2023/04/Coconut-960x700-2.jpg',
            'status' => true,
         ],
         [
            'title' => 'Happy Hours',
            'price' => '2 drinks for the price of 1',
            'description' => 'Our unbeatable Happy Hours offer two deliciously refreshing cocktails for the price of one.',
            'image' => 'https://www.theanvayabali.com/wp-content/uploads/2023/04/Cocktail-3-960x700-1.jpg',
            'status' => true,
         ],

        ];

        Promotion::insert($promotions);
    }
}
