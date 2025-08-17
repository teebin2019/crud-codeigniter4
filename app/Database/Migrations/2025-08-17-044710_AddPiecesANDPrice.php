<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPiecesANDPrice extends Migration
{
    public function up()
    {
        $fields = [
            'pieces' => [
                'type'       => 'INT',
                'constraint' => '11',
                'null'       => true,
                'after'      => 'id_item', // ใส่ชื่อ column ที่มีอยู่จริง
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
                'after'      => 'pieces',
            ],
        ];
        $this->forge->addColumn('orders', $fields);
    }

    public function down()
    {
        // Optional: Define how to revert the change
        $this->forge->dropColumn('orders', 'pieces');
        $this->forge->dropColumn('orders', 'price');
    }
}
