<?php

namespace Database\Seeders;

use App\Models\GroupsFriends;
use App\Models\Suggestions;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SecretFriends extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 37; $i++) {
            $data = [
                'name' => 'Teste' . $i,
                'username' => $i == 1 ? "wendeldomingos2014@gmail.com" : "wendelulhoa$i@gmail.com",
                'password'=> "12345678",
                'categories' => [1, 2]
            ];

            /* Cria o novo user. */
            $userId = User::create([
                'name' => $data['name'],
                'email' => $data['username'],
                'password' => Hash::make($data['password']),
            ])->id;

            if($userId == 1) {
                GroupsFriends::create([
                    'name'    => 'Natal',
                    'user_id' => $userId
                ]);
            }

            Suggestions::create([
                'user_id'     => $userId,
                'categories'  => json_encode($data['categories'] ?? []),
                'links'       => json_encode($data['links'] ?? []),
                'observation' => $data['observation'] ?? '',
                'group_id'    => 1
            ]);
        }
    }
}
