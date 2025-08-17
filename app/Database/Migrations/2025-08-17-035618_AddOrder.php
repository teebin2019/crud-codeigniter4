<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrder extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // ต้องใส่ให้ตรงกับ users.id
            ],
            'id_item' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // ต้องใส่ให้ตรงกับ items.id
            ],
        ]);

        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_item', 'items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
