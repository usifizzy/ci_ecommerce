<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderDetailsModel extends Migration
{
    public function up()
    {
        //['order_id', 'product_name', 'price', 'quantity', 'amount', 'product_id']
        $this->forge->addField([
            'id' => [
                'type'           => 'bigint',
                'constraint' => '20',
                'auto_increment' => true,
            ],
            'order_id' => [
                'type'       => 'bigint',
                'constraint' => '20',
            ],
            'product_id' => [
                'type'       => 'bigint',
                'constraint' => '20',
            ],
            'product_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'price' => [
                'type'       => 'decimal',
                'constraint' => '38,2',
            ],
            'quantity' => [
                'type'       => 'int',
                'constraint' => '10',
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('orderdetails');
    }

    public function down()
    {
        $this->forge->dropTable('orderdetails');
    }
}
