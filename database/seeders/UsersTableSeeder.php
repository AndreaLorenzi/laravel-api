<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'  => 'Andrea',
                'email' =>  'andrealorenzi247@gmail.com',
                'password' => Hash::make('Elisa13'),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}