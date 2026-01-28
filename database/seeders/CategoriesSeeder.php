<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::insert([
            [
                'categories_name' => 'Snacking',
                'type' => 'expense'
            ],
            [
                'categories_name' => 'Shopping',
                'type' => 'expense'
            ],
            [
                'categories_name' => 'pocket money',
                'type' => 'income'
            ],
            [
                'categories_name' => 'salary',
                'type' => 'income'
            ]
        ]);
    }
}
