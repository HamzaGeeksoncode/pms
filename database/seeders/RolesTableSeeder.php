<?php
namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Super Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Admin',
            ],
            [
                'id'    => 3,
                'title' => 'Cashier',
            ],   
            [
                'id'    => 4,
                'title' => 'Vendor',
            ],
            [
                'id'    => 5,
                'title' => 'Client',
            ],                                                           
        ];

        Role::insert($roles);
    }
}
