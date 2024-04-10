<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderModel extends Migration
{
    public function up()
    {
        //['order_no', 'amount', 'status']
        $this->forge->addField([
            'id' => [
                'type'           => 'bigint',
                'constraint' => '20',
                'auto_increment' => true,
            ],
            'order_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'amount' => [
                'type'       => 'decimal',
                'constraint' => '38,2',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
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
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
