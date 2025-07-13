<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSlugToTags extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tags', [
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'after'      => 'nama_tag', // taruh setelah kolom 'name'
                'null'       => true,   // supaya tidak error saat update awal
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tags', 'slug');
    }
}
