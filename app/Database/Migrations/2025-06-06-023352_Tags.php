<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TagsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'nama_tag'  => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tags', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('tags');
    }
}
