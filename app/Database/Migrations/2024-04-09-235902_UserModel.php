<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserModel extends Migration
{
    public function up()
    {
        //'name', 'email', 'password', 'role', 'phone']
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
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique' => true
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'unique' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '256',
            ],
            'address' => [
                'type' => 'text',
            ],
            'created_at' => [
                'type' => 'datetime', 
                'default' => new RawSql('CURRENT_TIMESTAMP')
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
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
