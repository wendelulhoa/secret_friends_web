<?php

namespace Database\Seeders;

use App\Models\Categories as ModelsCategories;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Jogos', 'Roupas', 'Calçados', 'Perfumes'
        ];

        foreach($categories as $category) {
            ModelsCategories::create([
                'name' => $category
            ]);
        }
    }
}
