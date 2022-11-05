<?php

namespace Database\Seeders;

use App\Models\Categories as ModelsCategories;
use App\Models\GroupsFriends;
use App\Models\Suggestions;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        $data = [
            'name' => 'Wendel Ulhoa',
            'username' => "wendelulhoa@gmail.com",
            'password'=> "12345678",
            'categories' => [1, 2]
        ];

        /* Cria o novo user. */
        $userId = User::create([
            'name' => $data['name'],
            'email' => $data['username'],
            'password' => Hash::make($data['password']),
        ])->id;

        GroupsFriends::create([
            'name'    => 'Natal',
            'user_id' => $userId
        ]);

        Suggestions::create([
            'user_id'     => $userId,
            'categories'  => json_encode($data['categories'] ?? []),
            'links'       => json_encode($data['links'] ?? []),
            'observation' => $data['observation'] ?? '',
            'group_id'    => 1
        ]);

        foreach($categories as $category) {
            ModelsCategories::create([
                'name' => $category
            ]);
        }
    }
}
