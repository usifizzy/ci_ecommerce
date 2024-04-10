<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductModel extends Migration
{
    public function up()
    {
        // ['name', 'price', 'category', 'description', 'image']
        $this->forge->addField([
            'id' => [
                'type'           => 'bigint',
                'constraint' => '20',
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'price' => [
                'type'       => 'decimal',
                'constraint' => '38',
                'decimal' => '2',
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type' => 'datetime',
                'constraint' => '6',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'constraint' => '6',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'constraint' => '6',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
