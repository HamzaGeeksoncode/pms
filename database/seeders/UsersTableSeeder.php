<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Super Admin',
                'email'          => 'admin@admin.com',
                'password'       =>  bcrypt('123456'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
