<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddItems extends Migration
{
    public function up()
    {
        //
        $this->forge->addField(
            [
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'title' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'description' => [
                    'type' => 'text',
                    'null' => true,
                ],
            ],
        );
        $this->forge->addKey('id', true);
        $this->forge->createTable('items');
    }

    public function down()
    {
        //
        $this->forge->dropTable('items');
    }
}
