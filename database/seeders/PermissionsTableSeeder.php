<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'user_create',
            ],
            [
                'id'    => '3',
                'title' => 'user_edit',
            ],
            [
                'id'    => '4',
                'title' => 'user_show',
            ],
            [
                'id'    => '5',
                'title' => 'user_delete',
            ],
            [
                'id'    => '6',
                'title' => 'user_access',
            ],
            [
                'id'    => '7',
                'title' => 'fuel_edit',
            ],      
            [
                'id'    => '8',
                'title' => 'fuel_access',
            ], 
            [
                'id'    => '9',
                'title' => 'petrol_station_management',
            ],               
            [
                'id'    => '10',
                'title' => 'fuel_management_access',
            ],
            [
                'id'    => '11',
                'title' => 'attachement_access',
            ],
            [
                'id'    => '12',
                'title' => 'report_editing_access',
            ],             
            [
                'id'    => '13',
                'title' => 'shift_management_access',
            ],             
            [
                'id'    => '14',
                'title' => 'discount_management_access',
            ],             
            [
                'id'    => '15',
                'title' => 'reading_management_access',
            ],             
            [
                'id'    => '16',
                'title' => 'transaction_management_access',
            ],             
            [
                'id'    => '17',
                'title' => 'billing_management_access',
            ],             
            [
                'id'    => '18',
                'title' => 'expense_management_access',
            ],             
            [
                'id'    => '19',
                'title' => 'bank_statement_management_access',
            ],       
            [
                'id'    => '20',
                'title' => 'tank_access',
            ],
            [
                'id'    => '21',
                'title' => 'vendorFuel_access',
            ],
            [
                'id'    => '22',
                'title' => 'client_access',
            ],
            [
                'id'    => '23',
                'title' => 'order_access',
            ],
            [
                'id'    => '24',
                'title' => 'role_access',
            ], 
            [
                'id'    => '25',
                'title' => 'permission_access',
            ],       
            [
                'id'    => '26',
                'title' => 'vendor_create',
            ], 
            [
                'id'    => '27',
                'title' => 'shift_access',
            ],                                                                                                                                    
        ];

        Permission::insert($permissions);
    }
}
