<?php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync([1,2,3,4,5,6,21,24,9,25]);
        Role::findOrFail(2)->permissions()->sync([7,8,9,21,22,1,10,20]);
        Role::findOrFail(3)->permissions()->sync([11,12,13,14,15,16,17,19,18,23]);
    }
}
