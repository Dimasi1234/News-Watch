<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BeritaTagsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'berita_id'  => ['type' => 'INT', 'unsigned' => true],
            'tag_id'     => ['type' => 'INT', 'unsigned' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('berita_id', 'berita', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tag_id', 'tags', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('berita_tags', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('berita_tags');
    }
}
