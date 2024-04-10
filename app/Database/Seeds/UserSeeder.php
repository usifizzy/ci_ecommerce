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
        //
        $data = [
            'name' => 'system admin',
            'email'    => 'usifizzy@yahoo.com',
            'role' => 'Admin',
            'phone' => '+441000000000',
            'password' => $user->password
        ];

        $this->db->table('users')->insert($data);
    }
}
