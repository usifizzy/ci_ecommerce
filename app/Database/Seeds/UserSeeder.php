<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Entities\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $user->setPassword('AdSystemMin12#');
        $userCustomers = new User();
        $userCustomers->setPassword('Customer12#');
        //
        $data = [
            [
                'name' => 'system admin',
                'email'    => 'usifizzy@yahoo.com',
                'role' => 'Admin',
                'phone' => '+441000000000',
                'password' => $user->password,
                'address' => 'WD Street, East London'
            ],
            [
                'name' => 'Jane Doe',
                'email'    => 'customer@usifizzy.com',
                'role' => 'User',
                'phone' => '+441000000001',
                'password' => $userCustomers->password,
                'address' => 'WD Street, East London'
            ],
            [
                'name' => 'Average Joe',
                'email'    => 'byer@usifizzy.com',
                'role' => 'User',
                'phone' => '+441000000002',
                'password' => $userCustomers->password,
                'address' => 'WD Street, East London'
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
