<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
// use CodeIgniter\Database\Forge;

class AlterAdminTable extends Migration
{
    public function up()
    {
        $fields = [
        	'profile_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]; 
        $this->forge->addColumn('admin', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('admin', 'profile_image');
    }
}
