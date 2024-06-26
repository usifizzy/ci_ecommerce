<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'name' => 'X.Z. Smart T.V Set',
                'price' => '10.99',
                'category' => 'Electronics',
                'description' => 'This is the description for Product 1.',
                'image' => 'dress.jpg'
            ],
            [
                'name' => 'Usi Mobile Phone',
                'price' => '15.49',
                'category' => 'Electronics',
                'description' => 'This is the description for Product 2.',
                'image' => 'dress.jpg'
            ],
            [
                'name' => 'winter Jacket',
                'price' => '50.99',
                'category' => 'Clothing',
                'description' => 'This is the description for Product 3.',
                'image' => 'dress.jpg'
            ],
            [
                'name' => 'Stock Jeans',
                'price' => '22.99',
                'category' => 'Clothing',
                'description' => 'This is the description for Product 3.',
                'image' => 'dress.jpg'
            ],
            [
                'name' => 'Head Warmer',
                'price' => '10.09',
                'category' => 'Clothing',
                'description' => 'This is the description for Product 3.',
                'image' => 'dress.jpg'
            ],
        ];
        
        $this->db->table('products')->insertBatch($data);
    }
}
